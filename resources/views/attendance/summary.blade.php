@extends('layouts.check')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Attendance Summary</h2>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('attendance.summary') }}" class="row g-3 align-items-end mb-4">
                <div class="col-md-4">
                    <label for="date" class="form-label">Select Date</label>
                    <input type="date" id="date" name="date" class="form-control" 
                           value="{{ $date }}" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i> Search
                    </button>
                    
                    @if(!empty($date))
                    <a href="{{ route('attendance.summary.export', ['date' => $date]) }}" 
                       class="btn btn-success ms-2" target="_blank">
                        <i class="fas fa-file-pdf me-1"></i> Export PDF
                    </a>
                    @endif
                </div>
            </form>

            @if(!empty($data) && count($data) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    <thead class="table-light">
                        <tr>
                            <th class="align-middle">Class</th>
                            @for ($p = 1; $p <= 8; $p++)
                                <th class="text-center">Period {{ $p }}</th>
                                <th class="text-center">Attendance</th>
                            @endfor
                        </tr>
                        <tr>
                            <th></th>
                            @for ($p = 1; $p <= 8; $p++)
                                <th class="text-center small">Teacher (Subject)</th>
                                <th class="text-center small">Present/Total</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $className => $periods)
                            <tr>
                                <td class="fw-bold">{{ $className }}</td>
                                @foreach ($periods as $period => $details)
                                    <td>
                                        @if(!empty($details['teacher']))
                                            {{ $details['teacher'] }}
                                            @if(!empty($details['subject']))
                                                <br>
                                                <small class="text-muted">({{ $details['subject'] }})</small>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center {{ $details['present']/$details['total_students'] < 0.8 ? 'text-danger' : 'text-success' }}">
                                        {{ $details['present'] }}/{{ $details['total_students'] }}
                                        <br>
                                        <small>({{ number_format(($details['present']/$details['total_students'])*100, 1) }}%)</small>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                No attendance data found for the selected date.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set max date to today
    const dateInput = document.getElementById('date');
    dateInput.max = new Date().toISOString().split('T')[0];
    
    // Highlight current row on hover
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