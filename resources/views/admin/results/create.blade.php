@extends('layouts.app')

@section('content')
    <h1>Add New Result</h1>
    <form method="POST" action="{{ route('admin.results.store') }}">
        @csrf
        <label>Item Name:</label>
        <input type="text" name="item_name" required><br><br>

        <label>Student Name:</label>
        <input type="text" name="student_name" required><br><br>

        <label>Class:</label>
        <input type="text" name="class" required><br><br>

        <label>Position:</label>
        <input type="number" name="position" min="1" required><br><br>

        <label>Grade:</label>
        <input type="text" name="grade" required><br><br>

        <button type="submit">Add Result</button>
    </form>
@endsection
