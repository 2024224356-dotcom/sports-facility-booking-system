<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<meta name="csrf-token"
content="{{ csrf_token() }}">

<title>

Sports Facility Booking System

</title>

@vite(['resources/css/app.css','resources/js/app.js'])

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>

*{

margin:0;

padding:0;

box-sizing:border-box;

font-family:'Poppins',sans-serif;

}

body{

margin:0;

overflow:hidden;

height:100vh;

background:#050816;

background-image:

linear-gradient(rgba(5,8,22,.92),rgba(5,8,22,.96)),

url('{{ asset('images/stadium.jpg') }}');

background-size:cover;

background-position:center;

background-repeat:no-repeat;

}

.background{

position:fixed;

top:0;

left:0;

width:100%;

height:100%;

background:

radial-gradient(circle at 15% 15%,
rgba(124,58,237,.35),
transparent 30%),

radial-gradient(circle at 85% 85%,
rgba(168,85,247,.25),
transparent 25%),

linear-gradient(135deg,
#060816,
#0F172A,
#111827);

z-index:-10;

}

.glow1{

position:absolute;

width:450px;

height:450px;

background:#7C3AED;

border-radius:50%;

filter:blur(180px);

opacity:.35;

top:-120px;

left:-120px;

animation:move1 12s infinite alternate;

}

.glow2{

position:absolute;

width:400px;

height:400px;

background:#A855F7;

border-radius:50%;

filter:blur(180px);

opacity:.25;

bottom:-120px;

right:-120px;

animation:move2 10s infinite alternate;

}

@keyframes move1{

0%{

transform:translate(0,0);

}

100%{

transform:translate(120px,70px);

}

}

@keyframes move2{

0%{

transform:translate(0,0);

}

100%{

transform:translate(-120px,-70px);

}

}

.wrapper{

display:flex;

justify-content:center;

align-items:center;

height:100vh;

padding:30px;

}

.login-card{

width:480px;

padding:55px;

background:rgba(17,24,39,.72);

backdrop-filter:blur(30px);

border-radius:30px;

border:1px solid rgba(255,255,255,.08);

box-shadow:

0 0 80px rgba(124,58,237,.28),

0 30px 60px rgba(0,0,0,.45);

position:relative;

overflow:hidden;

}

.login-card::before{

content:"";

position:absolute;

top:-150px;

right:-150px;

width:300px;

height:300px;

background:#7C3AED;

border-radius:50%;

filter:blur(120px);

opacity:.18;

}

.logo-area{

display:flex;

flex-direction:column;

align-items:center;

justify-content:center;

text-align:center;

margin-bottom:40px;

animation:fadeDown .8s ease;

}

.logo-area img{

display:block;

width:240px;

height:240px;

object-fit:contain;

margin:0 auto 25px auto;

filter:

drop-shadow(0 0 30px rgba(124,58,237,.55))

drop-shadow(0 0 60px rgba(168,85,247,.35));

transition:.35s ease;

}

.logo-area img:hover{

transform:scale(1.05);

filter:

drop-shadow(0 0 40px rgba(124,58,237,.85))

drop-shadow(0 0 80px rgba(168,85,247,.55));

}

.logo-title{

font-size:2.6rem;

font-weight:800;

letter-spacing:1px;

color:white;

margin-top:18px;

}

.logo-subtitle{

color:#9CA3AF;

font-size:.95rem;

margin-top:8px;

}

.form-box{

margin-top:35px;

}

.form-group{

margin-bottom:25px;

position:relative;

}

.form-group i{

position:absolute;

left:18px;

top:18px;

color:#8B5CF6;

font-size:18px;

}

.form-control{

width:100%;

padding:16px 18px 16px 52px;

background:#111827;

border:1px solid rgba(255,255,255,.05);

border-radius:16px;

color:white;

font-size:15px;

transition:.3s;

outline:none;

}

.form-control:focus{

border-color:#8B5CF6;

box-shadow:

0 0 25px rgba(139,92,246,.35);

}

.form-control::placeholder{

color:#6B7280;

}

.login-btn{

width:100%;

padding:16px;

margin-top:10px;

border:none;

border-radius:18px;

background:

linear-gradient(135deg,#6D28D9,#8B5CF6);

color:white;

font-size:16px;

font-weight:700;

cursor:pointer;

transition:.35s;

}

.login-btn:hover{

transform:translateY(-4px);

box-shadow:

0 15px 35px rgba(139,92,246,.45);

}

.options{

display:flex;

justify-content:space-between;

align-items:center;

margin-top:15px;

font-size:14px;

}

.options label{

color:#D1D5DB;

}

.options a{

color:#A78BFA;

text-decoration:none;

}

.options a:hover{

color:white;

}

.footer{

margin-top:35px;

text-align:center;

font-size:13px;

color:#6B7280;

}

@keyframes fadeDown{

0%{

opacity:0;

transform:translateY(-40px);

}

100%{

opacity:1;

transform:translateY(0);

}

}

@media(max-width:768px){

.login-card{

width:100%;

padding:35px;

border-radius:22px;

}

.logo-area img{

width:130px;

height:130px;

}

.logo-title{

font-size:1.6rem;

}

}

/* Animated particles */

.particle{

position:absolute;

border-radius:50%;

background:rgba(255,255,255,.12);

animation:float 18s linear infinite;

}

.p1{

width:10px;

height:10px;

top:15%;

left:10%;

animation-duration:15s;

}

.p2{

width:18px;

height:18px;

top:60%;

left:25%;

animation-duration:18s;

}

.p3{

width:14px;

height:14px;

top:35%;

right:15%;

animation-duration:20s;

}

.p4{

width:22px;

height:22px;

bottom:12%;

right:20%;

animation-duration:22s;

}

@keyframes float{

0%{

transform:translateY(0px);

opacity:.2;

}

50%{

opacity:1;

}

100%{

transform:translateY(-120px);

opacity:0;

}

}

.login-card{

animation:cardFade 1s ease;

}

@keyframes cardFade{

0%{

opacity:0;

transform:translateY(60px);

}

100%{

opacity:1;

transform:translateY(0);

}

}

.login-btn{

position:relative;

overflow:hidden;

}

.login-btn::before{

content:"";

position:absolute;

top:0;

left:-120%;

width:100%;

height:100%;

background:

linear-gradient(90deg,

transparent,

rgba(255,255,255,.35),

transparent);

transition:.8s;

}

.login-btn:hover::before{

left:120%;

}

</style>

</head>

<body>

<div class="background">

<div class="particle p1"></div>

<div class="particle p2"></div>

<div class="particle p3"></div>

<div class="particle p4"></div>

    <div class="glow1"></div>

    <div class="glow2"></div>

</div>

<div class="wrapper">

    <div class="login-card">

        <div class="logo-area">

    <img
        src="{{ asset('images/logo.png') }}"
        alt="UiTM Sports Logo">

    <h1 class="logo-title">

        SPORTS FACILITY

    </h1>

    <p class="logo-subtitle">

        Sports Facility Booking System

    </p>

</div>

        {{ $slot }}

        <div class="footer">

            © {{ date('Y') }}

            Universiti Teknologi MARA

            <br>

            Sports Facility Booking System

        </div>

    </div>

</div>

</body>

</html>