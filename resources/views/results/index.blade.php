@extends('layouts.app')

@section('content')
    <h1>Search Results</h1>
    <form method="GET" action="{{ route('results.index') }}">
        <input type="text" name="item_name" placeholder="Enter item name" value="{{ request('item_name') }}">
        <button type="submit">Search</button>
    </form>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if($results->count() > 0)
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
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
                        <td>{{ $result->position }}</td>
                        <td>{{ $result->grade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(request('item_name'))
        <p>No results found for "{{ request('item_name') }}"</p>
    @endif
@endsection
