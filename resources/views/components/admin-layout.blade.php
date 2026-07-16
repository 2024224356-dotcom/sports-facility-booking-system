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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
color:#F8FAFC;
overflow-x:hidden;
}

.wrapper{
display:flex;
min-height:100vh;
}

.sidebar{
position:fixed;
top:0;
left:0;
width:270px;
height:100vh;
background:#111827;
border-right:1px solid rgba(255,255,255,.05);
padding:30px;
overflow-y:auto;
}

.logo{
display:flex;
align-items:center;
gap:15px;
margin-bottom:45px;
}

.logo-icon{
width:58px;
height:58px;
display:flex;
align-items:center;
justify-content:center;
border-radius:16px;
background:linear-gradient(135deg,#6D28D9,#8B5CF6);
font-size:24px;
color:white;
}

.logo-title{
font-size:22px;
font-weight:700;
color:white;
}

.logo-sub{
font-size:12px;
color:#94A3B8;
}

.section-title{
margin-top:30px;
margin-bottom:15px;
font-size:11px;
letter-spacing:2px;
color:#64748B;
text-transform:uppercase;
font-weight:700;
}

.menu{
list-style:none;
padding:0;
margin:0;
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
font-weight:500;
transition:.25s;
}

.menu a:hover{
background:#1F2937;
color:white;
}

.menu a.active{
background:linear-gradient(135deg,#6D28D9,#8B5CF6);
color:white;
}

.main{
margin-left:270px;
width:calc(100% - 270px);
min-height:100vh;
}

.topbar{
height:80px;
background:#111827;
display:flex;
align-items:center;
justify-content:space-between;
padding:0 35px;
border-bottom:1px solid rgba(255,255,255,.05);
}

.page{
padding:35px;
}

.card-box,
.dashboard-card,
.chart-card,
.table-card,
.filter-card{
background:#111827;
border-radius:22px;
padding:25px;
border:1px solid rgba(255,255,255,.05);
box-shadow:0 20px 40px rgba(0,0,0,.25);
}

.table{
color:white;
}

.form-control,
.form-select{
background:#1F2937;
border:none;
color:white;
}

.form-control:focus,
.form-select:focus{
background:#1F2937;
color:white;
box-shadow:0 0 15px rgba(124,58,237,.35);
}

.btn-purple{
background:linear-gradient(135deg,#6D28D9,#8B5CF6);
color:white;
border:none;
}

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

Main Menu

</div>

<ul class="menu">

@if(Auth::user()->role=='admin')

<li>

<a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">

<i class="fas fa-chart-line"></i>

<span>Dashboard</span>

</a>

</li>

<li>

<a href="{{ route('facilities.index') }}" class="{{ request()->routeIs('facilities.*') ? 'active' : '' }}">

<i class="fas fa-building"></i>

<span>Facilities</span>

</a>

</li>

<li>

<a href="{{ route('facility-types.index') }}" class="{{ request()->routeIs('facility-types.*') ? 'active' : '' }}">

<i class="fas fa-layer-group"></i>

<span>Facility Types</span>

</a>

</li>

<li>

<a href="{{ route('facility-features.index') }}" class="{{ request()->routeIs('facility-features.*') ? 'active' : '' }}">

<i class="fas fa-star"></i>

<span>Facility Features</span>

</a>

</li>

<li>

<a href="{{ route('operating-hours.index') }}" class="{{ request()->routeIs('operating-hours.*') ? 'active' : '' }}">

<i class="fas fa-clock"></i>

<span>Operating Hours</span>

</a>

</li>

<li>

<a href="{{ route('bookings.index') }}" class="{{ request()->routeIs('bookings.index') ? 'active' : '' }}">

<i class="fas fa-calendar-check"></i>

<span>Manage Bookings</span>

</a>

</li>

<li>

<a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">

<i class="fas fa-users"></i>

<span>Users</span>

</a>

</li>

<li>

<a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">

<i class="fas fa-chart-column"></i>

<span>Reports</span>

</a>

</li>

<li>

<a href="{{ route('calendar.index') }}" class="{{ request()->routeIs('calendar.*') ? 'active' : '' }}">

<i class="fas fa-calendar-days"></i>

<span>Booking Calendar</span>

</a>

</li>

@endif

@if(Auth::user()->role=='student')

<li>

<a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">

<i class="fas fa-house-user"></i>

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

<i class="fas fa-history"></i>

<span>My Bookings</span>

</a>

</li>

<li>

<a href="{{ route('calendar.index') }}" class="{{ request()->routeIs('calendar.*') ? 'active' : '' }}">

<i class="fas fa-calendar-days"></i>

<span>Booking Calendar</span>

</a>

</li>

@endif

</ul>

<div class="section-title">

Account

</div>

<ul class="menu">

<li>

<a href="{{ route('profile.edit') }}">

<i class="fas fa-user"></i>

<span>Profile</span>

</a>

</li>

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

<h2 style="font-size:28px;font-weight:700;color:white;">

Sports Facility Booking System

</h2>

<p style="font-size:14px;color:#94A3B8;">

Cybernetics International College of Technology

</p>

@endif

</div>

<div style="display:flex;align-items:center;gap:18px;">

<div style="text-align:right;">

<div style="font-weight:600;">

{{ Auth::user()->name }}

</div>

<div style="font-size:13px;color:#94A3B8;">

{{ ucfirst(Auth::user()->role) }}

</div>

</div>

<div style="width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#6D28D9,#8B5CF6);font-weight:700;">

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

text:'{{ session("success") }}',

background:'#111827',

color:'#ffffff',

confirmButtonColor:'#7C3AED',

timer:2200,

showConfirmButton:false

});

</script>

@endif

@if(session('error'))

<script>

Swal.fire({

icon:'error',

title:'Error',

text:'{{ session("error") }}',

background:'#111827',

color:'#ffffff',

confirmButtonColor:'#EF4444'

});

</script>

@endif

@if($errors->any())

<script>

Swal.fire({

icon:'error',

title:'Validation Error',

html:`{!! implode('<br>',$errors->all()) !!}`,

background:'#111827',

color:'#ffffff',

confirmButtonColor:'#EF4444'

});

</script>

@endif

<style>

.table{

width:100%;

color:#fff;

margin-bottom:0;

}

.table thead{

background:#1F2937;

}

.table thead th{

padding:18px;

border:none;

font-weight:600;

}

.table tbody td{

padding:18px;

background:#111827;

border-color:#1F2937;

vertical-align:middle;

}

.btn-purple{

background:linear-gradient(135deg,#6D28D9,#8B5CF6);

border:none;

color:white;

border-radius:14px;

padding:12px 24px;

font-weight:600;

transition:.25s;

}

.btn-purple:hover{

color:white;

transform:translateY(-2px);

box-shadow:0 15px 25px rgba(124,58,237,.35);

}

.btn-grey{

background:#374151;

border:none;

color:white;

border-radius:14px;

padding:12px 24px;

}

.btn-grey:hover{

background:#4B5563;

color:white;

}

.form-control,

.form-select{

background:#1F2937;

border:none;

color:white;

border-radius:14px;

padding:13px;

}

.form-control:focus,

.form-select:focus{

background:#1F2937;

color:white;

box-shadow:0 0 18px rgba(124,58,237,.35);

}

.dashboard-card,

.table-card,

.chart-card,

.filter-card,

.card-box,

.stat-card{

background:#111827;

border-radius:22px;

border:1px solid rgba(255,255,255,.05);

box-shadow:0 20px 40px rgba(0,0,0,.25);

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

::-webkit-scrollbar{

width:8px;

}

::-webkit-scrollbar-track{

background:#111827;

}

::-webkit-scrollbar-thumb{

background:#7C3AED;

border-radius:50px;

}

@media(max-width:992px){

.sidebar{

width:90px;

padding:18px;

}

.logo-title,

.logo-sub,

.section-title,

.menu span{

display:none;

}

.main{

margin-left:90px;

width:calc(100% - 90px);

}

.menu a{

justify-content:center;

}

}

@media(max-width:768px){

.sidebar{

display:none;

}

.main{

margin-left:0;

width:100%;

}

.topbar{

flex-direction:column;

height:auto;

padding:20px;

align-items:flex-start;

}

.page{

padding:20px;

}

}

</style>

</body>

</html>