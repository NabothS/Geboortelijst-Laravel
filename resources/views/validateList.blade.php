<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Validate</title>
</head>
<body class="bodyValidation">
    <h1 class="tableTitle p-3">{{__('Wachtwoord')}}</h1>
        <form class="divValidation" action="{{ route('checkPass')}}" method="POST">
            @csrf
            <input name="password" type="password" class="passwordValidation" required>
            <input type="hidden" name="url" value="{{$url}}">
            <button type="submit" class="btnValidate">{{__('Check Wachtwoord')}}</button>
        </form>
</body>
</html>
