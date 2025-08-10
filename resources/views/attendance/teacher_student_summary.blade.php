@extends('layouts.check')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">
                <i class="fas fa-chart-pie me-2"></i>
                Teacher & Student Period Summary
                @if(!empty($date))
                <span class="float-end fs-5">Date: {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</span>
                @endif
            </h2>
        </div>
        
        <div class="card-body">
            <!-- Date Filter Form -->
            <form method="GET" action="{{ route('attendance.teacherStudentSummary') }}" class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="date" class="form-label">Select Date</label>
                    <input type="date" id="date" name="date" class="form-control" 
                           value="{{ $date ?? '' }}" max="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    @if(!empty($date))
                    <a href="{{ route('attendance.summary.export', ['date' => $date]) }}" 
                       class="btn btn-success">
                        <i class="fas fa-file-pdf me-1"></i> Export
                    </a>
                    @endif
                </div>
            </form>

            <!-- Teacher Summary Section -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-chalkboard-teacher me-2"></i>
                        Teacher Periods by Subject and Class
                    </h3>
                </div>
                <div class="card-body">
                    @if(count($teacherSummary) > 0)
                        @foreach($teacherSummary as $className => $subjects)
                        <div class="mb-4">
                            <h4 class="text-primary mb-3">
                                <i class="fas fa-users-class me-2"></i>
                                Class: {{ $className }}
                            </h4>
                            
                            @foreach($subjects as $subjectName => $teachers)
                            <div class="mb-3">
                                <h5 class="text-secondary">
                                    <i class="fas fa-book me-2"></i>
                                    Subject: {{ $subjectName }}
                                </h5>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-sm">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="60%">Teacher</th>
                                                <th width="40%">Periods Taken</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($teachers as $teacher)
                                            <tr>
                                                <td>{{ $teacher['teacher'] }}</td>
                                                <td>
                                                    <span class="badge bg-primary rounded-pill">
                                                        {{ $teacher['periods'] }} periods
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            No teacher data available for selected date.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Student Summary Section -->
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-user-graduate me-2"></i>
                        Student Attendance by Class
                    </h3>
                </div>
                <div class="card-body">
                    @if(count($studentSummary) > 0)
                        @foreach($studentSummary as $className => $students)
                        <div class="mb-4">
                            <h4 class="text-primary mb-3">
                                <i class="fas fa-users-class me-2"></i>
                                Class: {{ $className }}
                            </h4>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="60%">Student</th>
                                            <th width="40%">Periods Attended</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student['student'] }}</td>
                                            <td>
                                                <div class="progress" style="height: 24px;">
                                                    @php
                                                        $percentage = ($student['periods'] / 8) * 100;
                                                        $color = $percentage >= 80 ? 'bg-success' : 
                                                                ($percentage >= 50 ? 'bg-warning' : 'bg-danger');
                                                    @endphp
                                                    <div class="progress-bar {{ $color }}" 
                                                         role="progressbar" 
                                                         style="width: {{ $percentage }}%" 
                                                         aria-valuenow="{{ $percentage }}" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100">
                                                        {{ $student['periods'] }}/8
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            No student data available for selected date.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
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
