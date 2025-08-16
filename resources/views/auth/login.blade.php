@extends('layouts.app')

@section('content')
<div style="max-width:400px; margin:auto; padding:40px 0;">
    <h2>Login</h2>

    @if(session('error'))
        <div style="color:red;">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" required autofocus style="width:100%;">
        </div><br>

        <div>
            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password" required style="width:100%;">
        </div><br>

        <button type="submit" style="width:100%;">Login</button>
    </form>
</div>
@endsection
