<!-- resources/views/winners/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Festival Winners</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('winners.index') }}" class="mb-4">
        <input type="text" name="item" placeholder="Search by item name" value="{{ request('item') }}">
        <button type="submit">Search</button>
    </form>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Class</th>
                <th>Items</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @forelse($winners as $winner)
                <tr>
                    <td>{{ $winner->name }}</td>
                    <td>{{ $winner->class }}</td>
                    <td>{{ $winner->items }}</td>
                    <td>{{ $winner->grade }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No winners found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
