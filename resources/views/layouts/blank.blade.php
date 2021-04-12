<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/warehouse_logo.jpg') }}">
    <!-- Place favicon.ico in the root directory -->
    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-5.0.0-alpha.min.css') }}">
    <link href="{{ asset('css/LineIcons.2.0.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/animate.css') }} " rel="stylesheet" type="text/css">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet" type="text/css">
</head>

<body @yield('main_container') </body>

</html>
