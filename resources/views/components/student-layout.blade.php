<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') }}</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@vite(['resources/css/app.css','resources/js/app.js'])

<style>

*{

margin:0;

padding:0;

box-sizing:border-box;

font-family:'Poppins',sans-serif;

}

body{

background:#0F172A;

color:#fff;

overflow-x:hidden;

}

.wrapper{

display:flex;

min-height:100vh;

}

.sidebar{

position:fixed;

left:0;

top:0;

width:270px;

height:100vh;

background:#111827;

padding:30px;

border-right:1px solid rgba(255,255,255,.05);

}

.logo{

display:flex;

align-items:center;

gap:15px;

margin-bottom:40px;

}

.logo-icon{

width:58px;

height:58px;

border-radius:16px;

display:flex;

align-items:center;

justify-content:center;

background:linear-gradient(135deg,#6D28D9,#8B5CF6);

font-size:24px;

}

.logo-title{

font-size:22px;

font-weight:700;

}

.logo-sub{

font-size:12px;

color:#94A3B8;

}

.section-title{

margin:28px 0 15px;

font-size:11px;

color:#64748B;

letter-spacing:2px;

text-transform:uppercase;

}

.menu{

list-style:none;

}

.menu li{

margin-bottom:10px;

}

.menu a{

display:flex;

align-items:center;

gap:15px;

padding:15px 18px;

border-radius:16px;

text-decoration:none;

color:#E2E8F0;

transition:.25s;

font-weight:500;

}

.menu a:hover{

background:#1F2937;

}

.menu a.active{

background:linear-gradient(135deg,#6D28D9,#8B5CF6);

color:#fff;

}

.main{

margin-left:270px;

width:calc(100% - 270px);

}

.topbar{

height:80px;

display:flex;

justify-content:space-between;

align-items:center;

padding:0 35px;

background:#111827;

border-bottom:1px solid rgba(255,255,255,.05);

}

.page{

padding:35px;

}

.card-box{

background:#111827;

border-radius:22px;

padding:25px;

box-shadow:0 20px 40px rgba(0,0,0,.25);

border:1px solid rgba(255,255,255,.05);

}

.btn-logout{

background:#DC2626;

color:white;

padding:10px 20px;

border:none;

border-radius:12px;

cursor:pointer;

}

.table{

width:100%;

color:white;

}

.table thead{

background:#1F2937;

}

.table td,.table th{

padding:16px;

}

}

.badge-status{

padding:8px 16px;

border-radius:30px;

font-size:12px;

font-weight:600;

}

.pending{background:#F59E0B;}

.approved{background:#10B981;}

.completed{background:#3B82F6;}

.rejected{background:#EF4444;}

.cancelled{background:#6B7280;}

</style>

</head>

<body>

<div class="wrapper">

<div class="sidebar">

<div class="logo">

<div class="logo-icon">

<i class="fas fa-futbol"></i>

</div>

<div>

<div class="logo-title">

UITM Booking

</div>

<div class="logo-sub">

Sports Facility Booking System

</div>

</div>

</div>

<div class="section-title">

Student Menu

</div>

<ul class="menu">

<li>

<a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">

<i class="fas fa-house"></i>

<span>Dashboard</span>

</a>

</li>

<li>

<a href="{{ route('bookings.create') }}" class="{{ request()->routeIs('bookings.create') ? 'active' : '' }}">

<i class="fas fa-calendar-plus"></i>

<span>Book Facility</span>

</a>

</li>

<li>

<a href="{{ route('bookings.my') }}" class="{{ request()->routeIs('bookings.my') ? 'active' : '' }}">

<i class="fas fa-clock-rotate-left"></i>

<span>My Bookings</span>

</a>

</li>

<li>

<a href="{{ route('calendar.index') }}" class="{{ request()->routeIs('calendar.*') ? 'active' : '' }}">

<i class="fas fa-calendar-days"></i>

<span>Calendar</span>

</a>

</li>

<li>

<a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">

<i class="fas fa-user"></i>

<span>Profile</span>

</a>

</li>

</ul>

<div class="section-title">

Account

</div>

<ul class="menu">

<li>

<form method="POST" action="{{ route('logout') }}">

    @csrf

    <button
        type="submit"
        style="
            width:100%;
            display:flex;
            align-items:center;
            gap:15px;
            padding:15px 18px;
            border:none;
            border-radius:16px;
            background:transparent;
            color:#E2E8F0;
            cursor:pointer;
            font-size:15px;
            font-weight:500;
            transition:.25s;
        "
        onmouseover="this.style.background='#1F2937'"
        onmouseout="this.style.background='transparent'">

        <i class="fas fa-right-from-bracket"></i>

        <span>Logout</span>

    </button>

</form>

</li>

</ul>

</div>

<div class="main">

<div class="topbar">

<div>

@if(isset($header))

{{ $header }}

@else

<h2 style="font-size:28px;font-weight:700;">

Student Dashboard

</h2>

@endif

</div>

<div style="display:flex;align-items:center;gap:15px;">

<div style="text-align:right;">

<div style="font-weight:600;">

{{ Auth::user()->name }}

</div>

<div style="font-size:13px;color:#94A3B8;">

Student

</div>

</div>

<div style="width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,#6D28D9,#8B5CF6);display:flex;align-items:center;justify-content:center;font-weight:700;">

{{ strtoupper(substr(Auth::user()->name,0,1)) }}

</div>

</div>

</div>

<div class="page">

{{ $slot }}

</div>

</div>

</div>

@if(session('success'))

<script>

Swal.fire({

icon:'success',

title:'Success',

text:'{{ session('success') }}',

confirmButtonColor:'#7C3AED'

});

</script>

@endif

@if(session('error'))

<script>

Swal.fire({

icon:'error',

title:'Error',

text:'{{ session('error') }}',

confirmButtonColor:'#DC2626'

});

</script>

@endif

@if($errors->any())

<script>

Swal.fire({

icon:'error',

title:'Validation Error',

html:`{!! implode('<br>',$errors->all()) !!}`,

confirmButtonColor:'#DC2626'

});

</script>

@endif

</body>

</html>