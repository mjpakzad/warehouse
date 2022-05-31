<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Warehouse software that offers products and their quantity based on inventory and maximum profit">
    <meta name="author" content="Mojtaba Pakzad">
    <title>{{ __('Warehouse web application') }}</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <meta name="theme-color" content="#563d7c">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
@yield('content')
</body>
</html>
