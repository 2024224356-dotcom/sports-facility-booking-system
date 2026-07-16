<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') }}</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

@vite(['resources/css/app.css','resources/js/app.js'])

<style>

body{

margin:0;

font-family:'Poppins',sans-serif;

background:#0F172A;

color:white;

}

main{

padding:35px;

max-width:1400px;

margin:auto;

}

.page-header{

background:#111827;

padding:20px 35px;

border-bottom:1px solid rgba(255,255,255,.05);

margin-bottom:30px;

}

.page-header h2{

margin:0;

font-size:28px;

font-weight:700;

color:white;

}

.card{

background:#111827;

border:none;

border-radius:22px;

box-shadow:0 15px 35px rgba(0,0,0,.30);

}

</style>

</head>

<body>

@include('layouts.navigation')

@if(isset($header))

<div class="page-header">

{{ $header }}

</div>

@endif

<main>

{{ $slot }}

</main>

</body>

</html>