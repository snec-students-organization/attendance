@extends('layouts.mark')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">
                <i class="fas fa-calendar-check me-2"></i>
                View Attendance Records
            </h2>
        </div>
        
        <div class="card-body">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('attendance.view') }}" class="row g-3 mb-4">
                <div class="col-md-3">
                    <label for="class_id" class="form-label">Class</label>
                    <select name="class_id" id="class_id" class="form-select">
                        <option value="">All Classes</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" 
                           value="{{ request('date') }}">
                </div>
                
                <div class="col-md-3">
                    <label for="period" class="form-label">Period</label>
                    <select name="period" id="period" class="form-select">
                        <option value="">All Periods</option>
                        @for ($p = 1; $p <= 8; $p++)
                            <option value="{{ $p }}" {{ request('period') == $p ? 'selected' : '' }}>
                                Period {{ $p }}
                            </option>
                        @endfor
                    </select>
                </div>
                
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('attendance.view') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-sync me-1"></i> Reset
                    </a>
                </div>
            </form>

            @if(request()->filled('date'))
                <div class="alert alert-info mb-4">
                    <i class="fas fa-calendar-day me-2"></i>
                    Showing attendance for: <strong>{{ \Carbon\Carbon::parse(request('date'))->format('l, F j, Y') }}</strong>
                </div>
            @endif

            @if($attendances->count() > 0)
                @if(empty(request('class_id')))
                    @php
                        $groupedByClass = $attendances->groupBy('classModel.name');
                    @endphp

                    @foreach($groupedByClass as $className => $classAttendances)
                        <div class="class-section mb-5">
                            <div class="class-header bg-light p-3 mb-3 rounded">
                                <h3 class="mb-0">
                                    <i class="fas fa-users-class me-2"></i>
                                    Class: {{ $className }}
                                </h3>
                            </div>
                            
                            @php
                                $groupedByDate = empty(request('date')) ? $classAttendances->groupBy('date') : collect([request('date') => $classAttendances]);
                            @endphp

                            @foreach($groupedByDate as $attendanceDate => $dateAttendances)
                                <div class="date-section mb-4">
                                    <h4 class="text-primary mb-3">
                                        <i class="far fa-calendar-alt me-2"></i>
                                        {{ \Carbon\Carbon::parse($attendanceDate)->format('l, F j, Y') }}
                                    </h4>
                                    
                                    @php
                                        $groupedByPeriod = $dateAttendances->groupBy('period');
                                    @endphp

                                    @foreach($groupedByPeriod as $periodNumber => $periodAttendances)
                                        <div class="period-card card mb-4">
                                            <div class="card-header bg-light">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0">Period {{ $periodNumber }}</h5>
                                                    @php
                                                        $teacherAttendance = $periodAttendances->first(fn($att) => $att->student_id === null);
                                                        $subjectName = $teacherAttendance && $teacherAttendance->subject ? $teacherAttendance->subject->name : '-';
                                                    @endphp
                                                    <span class="badge bg-primary">
                                                        <i class="fas fa-book me-1"></i> {{ $subjectName }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="card-body">
                                                <div class="teacher-info mb-3">
                                                    <p class="mb-1">
                                                        <strong><i class="fas fa-chalkboard-teacher me-2"></i>Teacher:</strong>
                                                        @if($teacherAttendance)
                                                            @if($teacherAttendance->status === 'free')
                                                                <span class="badge bg-secondary">Free Period</span>
                                                            @elseif($teacherAttendance->teacher)
                                                                {{ $teacherAttendance->teacher->name }}
                                                            @else
                                                                <span class="text-muted">Not recorded</span>
                                                            @endif
                                                        @else
                                                            <span class="text-muted">Not recorded</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover table-sm">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th width="40%">Student Name</th>
                                                                <th width="20%">Status</th>
                                                                <th width="40%">Reason (if absent)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($periodAttendances as $attendance)
                                                                @if($attendance->student)
                                                                    <tr class="{{ $attendance->status === 'absent' ? 'table-warning' : 'table-success' }}">
                                                                        <td>{{ $attendance->student->name }}</td>
                                                                        <td>
                                                                            <span class="badge {{ $attendance->status === 'absent' ? 'bg-warning' : 'bg-success' }}">
                                                                                {{ ucfirst($attendance->status) }}
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            @if($attendance->status === 'absent')
                                                                                {{ $attendance->reason ?: 'No reason provided' }}
                                                                            @else
                                                                                <span class="text-muted">N/A</span>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                @else
                    <div class="class-section mb-4">
                        <div class="class-header bg-light p-3 mb-3 rounded">
                            <h3 class="mb-0">
                                <i class="fas fa-users-class me-2"></i>
                                Class: {{ $attendances->first()->classModel->name ?? 'N/A' }}
                            </h3>
                        </div>
                        
                        @php
                            $groupedByDate = empty(request('date')) ? $attendances->groupBy('date') : collect([request('date') => $attendances]);
                        @endphp

                        @foreach($groupedByDate as $attendanceDate => $dateAttendances)
                            <div class="date-section mb-4">
                                <h4 class="text-primary mb-3">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    {{ \Carbon\Carbon::parse($attendanceDate)->format('l, F j, Y') }}
                                </h4>
                                
                                @php
                                    $groupedByPeriod = $dateAttendances->groupBy('period');
                                @endphp

                                @foreach($groupedByPeriod as $periodNumber => $periodAttendances)
                                    <div class="period-card card mb-4">
                                        <div class="card-header bg-light">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">Period {{ $periodNumber }}</h5>
                                                @php
                                                    $teacherAttendance = $periodAttendances->first(fn($att) => $att->student_id === null);
                                                    $subjectName = $teacherAttendance && $teacherAttendance->subject ? $teacherAttendance->subject->name : '-';
                                                @endphp
                                                <span class="badge bg-primary">
                                                    <i class="fas fa-book me-1"></i> {{ $subjectName }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body">
                                            <div class="teacher-info mb-3">
                                                <p class="mb-1">
                                                    <strong><i class="fas fa-chalkboard-teacher me-2"></i>Teacher:</strong>
                                                    @if($teacherAttendance)
                                                        @if($teacherAttendance->status === 'free')
                                                            <span class="badge bg-secondary">Free Period</span>
                                                        @elseif($teacherAttendance->teacher)
                                                            {{ $teacherAttendance->teacher->name }}
                                                        @else
                                                            <span class="text-muted">Not recorded</span>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">Not recorded</span>
                                                    @endif
                                                </p>
                                            </div>
                                            
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-sm">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th width="40%">Student Name</th>
                                                            <th width="20%">Status</th>
                                                            <th width="40%">Reason (if absent)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($periodAttendances as $attendance)
                                                            @if($attendance->student)
                                                                <tr class="{{ $attendance->status === 'absent' ? 'table-warning' : 'table-success' }}">
                                                                    <td>{{ $attendance->student->name }}</td>
                                                                    <td>
                                                                        <span class="badge {{ $attendance->status === 'absent' ? 'bg-warning' : 'bg-success' }}">
                                                                            {{ ucfirst($attendance->status) }}
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        @if($attendance->status === 'absent')
                                                                            {{ $attendance->reason ?: 'No reason provided' }}
                                                                        @else
                                                                            <span class="text-muted">N/A</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Updated Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm">
                            {{ $attendances->appends(request()->except('page'))->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </ul>
                    </nav>
                </div>
            @else
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    No attendance records found matching your criteria.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .pagination {
        flex-wrap: wrap;
        justify-content: center;
    }

    .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        margin: 0 2px;
        border-radius: 4px !important;
    }

    .page-item:first-child .page-link,
    .page-item:last-child .page-link {
        border-radius: 4px !important;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set max date to today
    document.getElementById('date').max = new Date().toISOString().split('T')[0];
    
    // Highlight table rows on hover
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', () => {
            row.classList.add('table-active');
        });
        row.addEventListener('mouseleave', () => {
            row.classList.remove('table-active');
        });
    });
});
</script>
@endsection











