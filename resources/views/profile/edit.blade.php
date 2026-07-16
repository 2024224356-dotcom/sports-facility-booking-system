@php
$layout = Auth::user()->role === 'admin'
    ? 'admin-layout'
    : 'student-layout';
@endphp

<x-dynamic-component :component="$layout">

<x-slot name="header">

<div>

<h2 style="font-size:30px;font-weight:700;color:white;">

My Profile

</h2>

<p style="color:#94A3B8;">

Manage your account settings

</p>

</div>

</x-slot>

<style>

.profile-card{

background:#111827;

border-radius:22px;

padding:30px;

border:1px solid rgba(255,255,255,.05);

box-shadow:0 20px 40px rgba(0,0,0,.30);

margin-bottom:30px;

}

</style>

<div class="profile-card">

@include('profile.partials.update-profile-information-form')

</div>

<div class="profile-card">

@include('profile.partials.update-password-form')

</div>

<div class="profile-card">

@include('profile.partials.delete-user-form')

</div>

</x-dynamic-component>