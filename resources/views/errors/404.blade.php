<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>404</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
</head>
<body>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-auto text-center">
            <h1>404</h1>
            <h3>Not Found!</h3>
            <p>
                <a href="/">Go home?</a>
            </p>
        </div>
    </div>
</div>
</body>
<style>
    .container {
        margin-top: 20%;
    }
</style>
</html>


