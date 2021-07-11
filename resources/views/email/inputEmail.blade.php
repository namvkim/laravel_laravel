<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if (session('message'))
        <h2 style="color:red">{{ session('message') }}</h2>
    @endif
    <form action="{{ route('sendEmail') }}" method="POST" role="form">
        @csrf
        <h1>Send email</h1>
        <input type="text" name="txtEmail"><br />

        <input type="submit" value="send">
    </form>
</body>

</html>
