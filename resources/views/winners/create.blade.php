<!-- resources/views/winners/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Winner</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('winners.store') }}">
        @csrf
        <div>
            <label>Name:</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label>Class:</label><br>
            <input type="text" name="class" value="{{ old('class') }}" required>
        </div>

        <div>
            <label>Items:</label><br>
            <textarea name="items" required>{{ old('items') }}</textarea>
        </div>

        <div>
            <label>Grade:</label><br>
            <input type="text" name="grade" value="{{ old('grade') }}" required>
        </div>

        <button type="submit">Add Winner</button>
    </form>
</div>
@endsection
