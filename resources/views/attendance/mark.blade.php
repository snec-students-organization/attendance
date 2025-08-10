@extends('layouts.mark')

@section('header', 'Mark Attendance for All Periods')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form method="POST" action="{{ route('attendance.storeAllPeriods') }}" class="needs-validation" novalidate>
            @csrf

            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="class_id" class="form-label">Select Class</label>
                    <select id="class_id" name="class_id" class="form-select" required>
                        <option value="">-- Select Class --</option>
                        @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select a class</div>
                </div>

                <div class="col-md-4">
                    <label for="pin" class="form-label">Class PIN</label>
                    <input type="password" id="pin" name="pin" class="form-control" required value="{{ old('pin') }}" />
                    @error('pin')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" id="date" name="date" class="form-control" required 
                           max="{{ date('Y-m-d') }}" value="{{ old('date', date('Y-m-d')) }}" />
                    @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="my-4">

            @foreach($periods as $period)
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Period {{ $period }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="subject_id_{{ $period }}" class="form-label">Subject</label>
                            <select name="subjects[{{ $period }}]" id="subject_id_{{ $period }}" class="form-select" required>
                                <option value="">-- Select Subject --</option>
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" 
                                    {{ old('subjects.' . $period) == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('subjects.' . $period)
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="teacher_id_{{ $period }}" class="form-label">Teacher</label>
                            <select name="teachers[{{ $period }}]" id="teacher_id_{{ $period }}" class="form-select" required>
                                <option value="">-- Select Teacher --</option>
                                @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" 
                                    {{ old('teachers.' . $period) == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                                @endforeach
                                <option value="free" {{ old('teachers.' . $period) == 'free' ? 'selected' : '' }}>Free Period</option>
                            </select>
                            @error('teachers.' . $period)
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <h6 class="mt-4 mb-3">Student Attendance</h6>
                    <div class="student-list" data-period="{{ $period }}">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Please select a class to load students
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Save Attendance for All Periods
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Shows/hides reason input for absent status
function handleStatusChange(e, studentId, period) {
    const reasonBox = document.getElementById(`reason_box_${period}_${studentId}`);
    if (!reasonBox) return;
    
    reasonBox.style.display = e.target.value === 'absent' ? 'block' : 'none';
    if (e.target.value !== 'absent') {
        reasonBox.value = ''; // Clear reason when status changes from absent
    }
}

// Renders student list for a given period
function renderStudentList(period, students) {
    let html = '<div class="table-responsive"><table class="table table-sm">';
    html += `
        <thead>
            <tr>
                <th width="45%">Student Name</th>
                <th width="25%">Status</th>
                <th width="30%">Reason (if absent)</th>
            </tr>
        </thead>
        <tbody>
    `;
    
    students.forEach(student => {
        html += `
            <tr>
                <td>${student.name}</td>
                <td>
                    <select name="students[${period}][${student.id}][status]"
                        class="form-select form-select-sm"
                        onchange="handleStatusChange(event, ${student.id}, ${period})">
                        <option value="present" selected>Present</option>
                        <option value="absent">Absent</option>
                    </select>
                </td>
                <td>
                    <input
                        type="text"
                        name="students[${period}][${student.id}][reason]"
                        id="reason_box_${period}_${student.id}"
                        class="form-control form-control-sm"
                        placeholder="Enter reason"
                        style="display:none;"
                    />
                </td>
            </tr>
        `;
    });
    
    html += '</tbody></table></div>';
    return html;
}

// Load students when class is selected
document.getElementById('class_id').addEventListener('change', function() {
    const classId = this.value;
    const studentLists = document.querySelectorAll('.student-list');
    const loadingHtml = `
        <div class="text-center py-3">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading students...</p>
        </div>
    `;

    if (!classId) {
        studentLists.forEach(el => el.innerHTML = `
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Please select a class to load students
            </div>
        `);
        return;
    }

    studentLists.forEach(el => el.innerHTML = loadingHtml);
    
    fetch('/attendance/students/' + classId)
        .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        })
        .then(data => {
            studentLists.forEach(el => {
                const period = el.getAttribute('data-period');
                el.innerHTML = renderStudentList(period, data);
                
                // Restore previous selections if validation failed
                const formData = @json(old('students.' . $period, []));
                if (formData[period]) {
                    Object.entries(formData[period]).forEach(([studentId, data]) => {
                        const statusSelect = el.querySelector(`select[name="students[${period}][${studentId}][status]"]`);
                        const reasonInput = el.querySelector(`input[name="students[${period}][${studentId}][reason]"]`);
                        
                        if (statusSelect && data.status) {
                            statusSelect.value = data.status;
                            if (data.status === 'absent') {
                                reasonInput.style.display = 'block';
                                if (data.reason) reasonInput.value = data.reason;
                            }
                        }
                    });
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
            studentLists.forEach(el => el.innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Error loading students. Please try again.
                </div>
            `);
        });
});

// Bootstrap form validation
(function () {
    'use strict'
    
    const forms = document.querySelectorAll('.needs-validation')
    
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            
            form.classList.add('was-validated')
        }, false)
    })
})();

// Initialize form if returning with validation errors
document.addEventListener('DOMContentLoaded', () => {
    const classSelect = document.getElementById('class_id');
    if (classSelect.value) {
        classSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection