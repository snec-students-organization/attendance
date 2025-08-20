@extends('layouts.result')
@section('content')
<div class="container mt-4 p-3 bg-light rounded shadow-sm">
    <h2 class="mb-4 text-primary border-bottom pb-2 d-flex justify-content-between align-items-center">
        Search Results
        
    </h2>

    <form method="GET" action="{{ route('results.search') }}" class="mb-4 p-3 bg-white rounded shadow-sm">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="item_name" class="form-control" placeholder="Item Name" value="{{ request('item_name') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="student_name" class="form-control" placeholder="Student Name" value="{{ request('student_name') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="class" class="form-control" placeholder="Class" value="{{ request('class') }}">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>

    @if($results->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>Item Name</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Position</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{ $result->item_name }}</td>
                        <td>{{ $result->student_name }}</td>
                        <td>{{ $result->class }}</td>
                        <td class="text-center">{{ $result->position }}</td>
                        <td class="text-center">
                            <span class="badge rounded-pill bg-{{ $result->grade == 'A' ? 'success' : ($result->grade == 'B' ? 'info' : ($result->grade == 'C' ? 'warning' : 'secondary')) }}">
                                {{ $result->grade }}
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info mt-4">
            <i class="bi bi-info-circle-fill"></i> No results found.
        </div>
    @endif
</div>
@endsection