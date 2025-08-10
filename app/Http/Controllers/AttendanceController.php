<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Attendance;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class AttendanceController extends Controller
{
    // Show attendance form for marking all 8 periods at once
    public function create()
    {
        $classes = ClassModel::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $periods = range(1, 8);

        return view('attendance.mark', compact('classes', 'teachers', 'subjects', 'periods'));
    }

    // Store attendance for a single period (with absence reason)
    public function store(Request $request)
    {
        $request->validate([
            'class_id'   => 'required|exists:classes,id',
            'pin'        => 'required|string',
            'date'       => 'required|date',
            'period'     => 'required|integer|between:1,8',
            'students'   => 'nullable|array',
            'teacher_id' => 'required',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $class = ClassModel::find($request->class_id);
        if (!$class || $class->pin !== $request->pin) {
            return redirect()->back()
                ->withErrors(['pin' => 'Invalid PIN for the selected class.'])
                ->withInput();
        }

        $date = Carbon::parse($request->date);
        if ($date->format('l') === 'Friday') {
            return redirect()->back()->withErrors(['date' => 'Attendance cannot be marked for Fridays'])->withInput();
        }

        $class_id = $request->class_id;
        $period = $request->period;

        $exists = Attendance::where('class_id', $class_id)
            ->where('date', $date->toDateString())
            ->where('period', $period)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['attendance' => 'Attendance already recorded for this class, date, and period'])
                ->withInput();
        }

        if ($request->filled('students')) {
            foreach ($request->students as $student_id => $studentData) {
                if (is_array($studentData)) {
                    $status = $studentData['status'] ?? 'present';
                    $reason = ($status == 'absent') ? ($studentData['reason'] ?? null) : null;
                } else {
                    $status = $studentData;
                    $reason = null;
                }

                Attendance::create([
                    'class_id'   => $class_id,
                    'date'       => $date->toDateString(),
                    'period'     => $period,
                    'student_id' => $student_id,
                    'teacher_id' => null,
                    'subject_id' => $request->subject_id,
                    'status'     => $status,
                    'reason'     => $reason,
                ]);
            }
        }

        $teacherId = $request->teacher_id;

        if ($teacherId === 'free') {
            Attendance::create([
                'class_id'   => $class_id,
                'date'       => $date->toDateString(),
                'period'     => $period,
                'student_id' => null,
                'teacher_id' => null,
                'subject_id' => $request->subject_id,
                'status'     => 'free',
                'reason'     => null,
            ]);
        } else {
            Attendance::create([
                'class_id'   => $class_id,
                'date'       => $date->toDateString(),
                'period'     => $period,
                'student_id' => null,
                'teacher_id' => $teacherId,
                'subject_id' => $request->subject_id,
                'status'     => 'present',
                'reason'     => null,
            ]);
        }

        return redirect()->back()->with('success', 'Attendance saved successfully.');
    }

    // Store attendance for all 8 periods in one submission (with reason)
    public function storeAllPeriods(Request $request)
    {
        $request->validate([
            'class_id'  => 'required|exists:classes,id',
            'pin'       => 'required|string',
            'date'      => 'required|date',
            'students'  => 'nullable|array',           // students[period][student_id] or students[period][student_id][status|reason]
            'teachers'  => 'required|array',           // teachers[period]
            'subjects'  => 'required|array',           // subjects[period]
        ]);

        $class = ClassModel::find($request->class_id);
        if (!$class || $class->pin !== $request->pin) {
            return redirect()->back()->withErrors(['pin' => 'Invalid PIN for the selected class.'])->withInput();
        }

        $date = Carbon::parse($request->date);
        if ($date->format('l') === 'Friday') {
            return redirect()->back()->withErrors(['date' => 'Attendance cannot be marked for Fridays'])->withInput();
        }

        $class_id = $request->class_id;

        for ($period = 1; $period <= 8; $period++) {
            $exists = Attendance::where('class_id', $class_id)
                ->where('date', $date->toDateString())
                ->where('period', $period)
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withErrors(['attendance' => "Attendance for Period $period on the selected date already exists."])
                    ->withInput();
            }

            $subjectId = $request->input("subjects.$period");
            $teacherId = $request->input("teachers.$period");

            // Save student attendance for this period with reason
            if ($request->filled("students.$period")) {
                foreach ($request->input("students.$period") as $student_id => $studentData) {
                    if (is_array($studentData)) {
                        $status = $studentData['status'] ?? 'present';
                        $reason = ($status == 'absent') ? ($studentData['reason'] ?? null) : null;
                    } else {
                        $status = $studentData;
                        $reason = null;
                    }

                    Attendance::create([
                        'class_id'   => $class_id,
                        'date'       => $date->toDateString(),
                        'period'     => $period,
                        'student_id' => $student_id,
                        'teacher_id' => null,
                        'subject_id' => $subjectId,
                        'status'     => $status,
                        'reason'     => $reason,
                    ]);
                }
            }

            // Save teacher attendance or free period for this period
            if ($teacherId === 'free') {
                Attendance::create([
                    'class_id'   => $class_id,
                    'date'       => $date->toDateString(),
                    'period'     => $period,
                    'student_id' => null,
                    'teacher_id' => null,
                    'subject_id' => $subjectId,
                    'status'     => 'free',
                    'reason'     => null,
                ]);
            } else {
                Attendance::create([
                    'class_id'   => $class_id,
                    'date'       => $date->toDateString(),
                    'period'     => $period,
                    'student_id' => null,
                    'teacher_id' => $teacherId,
                    'subject_id' => $subjectId,
                    'status'     => 'present',
                    'reason'     => null,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Attendance for all 8 periods saved successfully.');
    }

    // AJAX: get students for selected class
    public function getStudents($classId)
    {
        $students = Student::where('class_id', $classId)->get();
        return response()->json($students);
    }

    // View attendance with filtering (shows reason)
    public function index(Request $request)
    {
        $classes = ClassModel::all();
        $class_id = $request->input('class_id');
        $date = $request->input('date');
        $period = $request->input('period');

        $query = Attendance::with(['student', 'teacher.subject', 'classModel', 'subject']);

        if ($class_id) {
            $query->where('class_id', $class_id);
        }
        if ($date) {
            $query->where('date', $date);
        }
        if ($period) {
            $query->where('period', $period);
        }

        $attendances = $query->orderBy('date', 'desc')->paginate(20);

        return view('attendance.view', compact('attendances', 'classes', 'class_id', 'date', 'period'));
    }

    // Attendance summary page with optional date filter
    public function summaryByDate(Request $request)
    {
        $date = $request->input('date');

        if (!$date) {
            $data = [];
            return view('attendance.summary', compact('date', 'data'));
        }

        $request->validate(['date' => 'date']);

        $classes = ClassModel::all();
        $data = [];

        foreach ($classes as $class) {
            $totalStudents = $class->students()->count();

            $teacherAttendances = Attendance::where('class_id', $class->id)
                ->where('date', $date)
                ->whereNull('student_id')
                ->with('teacher.subject', 'subject')
                ->get()
                ->keyBy('period');

            $studentAttendances = Attendance::where('class_id', $class->id)
                ->where('date', $date)
                ->whereNotNull('student_id')
                ->get()
                ->groupBy('period');

            $periodData = [];

            for ($period = 1; $period <= 8; $period++) {
                $teacherAttendance = $teacherAttendances->get($period);

                if (!$teacherAttendance) {
                    $teacherName = '-';
                    $subjectName = '';
                } else {
                    if ($teacherAttendance->status === 'free') {
                        $teacherName = 'Free Period';
                        $subjectName = '';
                    } elseif ($teacherAttendance->teacher) {
                        $teacherName = $teacherAttendance->teacher->name;
                        $subjectName = $teacherAttendance->subject->name ?? '';
                    } else {
                        $teacherName = '-';
                        $subjectName = '';
                    }
                }

                $studentsPresentCount = 0;
                if (isset($studentAttendances[$period])) {
                    $studentsPresentCount = $studentAttendances[$period]->where('status', 'present')->count();
                }

                $periodData[$period] = [
                    'teacher' => $teacherName,
                    'subject' => $subjectName,
                    'present' => $studentsPresentCount,
                    'total_students' => $totalStudents,
                ];
            }

            $data[$class->name] = $periodData;
        }

        return view('attendance.summary', compact('date', 'data'));
    }

    // Export attendance summary as PDF in landscape with heading
    public function exportSummaryPDF(Request $request)
    {
        $request->validate(['date' => 'required|date']);

        $date = $request->input('date');

        $classes = ClassModel::all();
        $data = [];

        foreach ($classes as $class) {
            $totalStudents = $class->students()->count();

            $teacherAttendances = Attendance::where('class_id', $class->id)
                ->where('date', $date)
                ->whereNull('student_id')
                ->with('teacher.subject', 'subject')
                ->get()
                ->keyBy('period');

            $studentAttendances = Attendance::where('class_id', $class->id)
                ->where('date', $date)
                ->whereNotNull('student_id')
                ->get()
                ->groupBy('period');

            $periodData = [];

            for ($period = 1; $period <= 8; $period++) {
                $teacherAttendance = $teacherAttendances->get($period);

                if (!$teacherAttendance) {
                    $teacherName = '-';
                    $subjectName = '';
                } else {
                    if ($teacherAttendance->status === 'free') {
                        $teacherName = 'Free Period';
                        $subjectName = '';
                    } elseif ($teacherAttendance->teacher) {
                        $teacherName = $teacherAttendance->teacher->name;
                        $subjectName = $teacherAttendance->subject->name ?? '';
                    } else {
                        $teacherName = '-';
                        $subjectName = '';
                    }
                }

                $studentsPresentCount = 0;
                if (isset($studentAttendances[$period])) {
                    $studentsPresentCount = $studentAttendances[$period]->where('status', 'present')->count();
                }

                $periodData[$period] = [
                    'teacher' => $teacherName,
                    'subject' => $subjectName,
                    'present' => $studentsPresentCount,
                    'total_students' => $totalStudents,
                ];
            }

            $data[$class->name] = $periodData;
        }

        $pdf = Pdf::loadView('attendance.summary_pdf', compact('date', 'data'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('Attendance_Summary_' . $date . '.pdf');
    }

    // Period summary for teacher & students (optional: with reason, as described before)
    public function teacherStudentSummary(Request $request)
    {
        $date = $request->input('date');
        $noSubject = Subject::where('name', 'No Subject')->first();
        $noSubjectId = $noSubject ? $noSubject->id : null;

        $dateCondition = function ($query) use ($date) {
            if ($date) {
                $query->where('date', $date);
            }
        };

        $teacherPeriods = Attendance::where('status', '!=', 'free')
            ->whereNotNull('teacher_id')
            ->when($noSubjectId, function ($query) use ($noSubjectId) {
                $query->where('subject_id', '!=', $noSubjectId);
            })
            ->when($date, $dateCondition)
            ->selectRaw('class_id, subject_id, teacher_id, count(*) as periods_count')
            ->groupBy('class_id', 'subject_id', 'teacher_id')
            ->with(['teacher', 'subject', 'classModel'])
            ->get();

        $teacherSummary = [];
        foreach ($teacherPeriods as $rec) {
            $className = $rec->classModel->name ?? 'Unknown';
            $subjectName = $rec->subject->name ?? 'Unknown';

            $teacherSummary[$className][$subjectName][] = [
                'teacher' => $rec->teacher->name ?? '-',
                'periods' => $rec->periods_count,
            ];
        }

        // Count only 'present' student attendances!
        $studentPeriods = Attendance::where('status', 'present')
            ->whereNotNull('student_id')
            ->when($date, $dateCondition)
            ->selectRaw('class_id, student_id, count(*) as periods_count')
            ->groupBy('class_id', 'student_id')
            ->with(['student', 'classModel'])
            ->get();

        $studentSummary = [];
        foreach ($studentPeriods as $rec) {
            $className = $rec->classModel->name ?? 'Unknown';

            $studentSummary[$className][] = [
                'student' => $rec->student->name ?? '-',
                'periods' => $rec->periods_count,
            ];
        }

        return view('attendance.teacher_student_summary', compact('teacherSummary', 'studentSummary', 'date'));
    }
}

