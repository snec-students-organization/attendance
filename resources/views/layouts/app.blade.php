<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>College Attendance System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        label { display: block; margin-top: 10px; }
        select, input[type="date"] { padding: 5px; margin-top: 5px; width: 220px; }
        button { margin-top: 20px; padding: 10px 20px; }
        .error { color: red; }
        .success { color: green; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>

@if(session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@yield('content')

</body>
</html>

