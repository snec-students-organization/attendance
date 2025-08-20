@extends('layouts.result')
@section('content')

<div class="container mt-5">
    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Upload Student Results</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.results.store') }}" method="POST">
                @csrf
                <div id="results-container">
                    <div class="row g-3 result-row mb-3">
                        <div class="col-md-2">
                            <input type="text" name="item_name[]" class="form-control" placeholder="Item Name" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="student_name[]" class="form-control" placeholder="Student Name" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="class[]" class="form-control" placeholder="Class" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="position[]" class="form-control" placeholder="Position" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="grade[]" class="form-control" placeholder="Grade" required>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-outline-primary" onclick="addRow()">
                        <i class="bi bi-plus-circle"></i> Add More
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-upload"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Bootstrap + Custom Script --}}
<script>
function addRow() {
    let container = document.getElementById('results-container');
    let row = document.createElement('div');
    row.classList.add('row', 'g-3', 'result-row', 'mb-3');
    row.innerHTML = `
        <div class="col-md-2">
            <input type="text" name="item_name[]" class="form-control" placeholder="Item Name" required>
        </div>
        <div class="col-md-3">
            <input type="text" name="student_name[]" class="form-control" placeholder="Student Name" required>
        </div>
        <div class="col-md-2">
            <input type="text" name="class[]" class="form-control" placeholder="Class" required>
        </div>
        <div class="col-md-2">
            <input type="text" name="position[]" class="form-control" placeholder="Position" required>
        </div>
        <div class="col-md-2">
            <input type="text" name="grade[]" class="form-control" placeholder="Grade" required>
        </div>
        <div class="col-md-1 d-flex align-items-center">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(row);
}

function removeRow(button) {
    button.closest('.result-row').remove();
}
</script>

@endsection
