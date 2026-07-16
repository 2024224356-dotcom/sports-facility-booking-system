<x-student-layout>

<x-slot name="header">

<div>

<h2 style="font-size:30px;font-weight:700;color:white;">

My Profile

</h2>

<p style="color:#94A3B8;">

Manage your account information

</p>

</div>

</x-slot>

<style>

.profile-card{

background:#111827;

border-radius:22px;

padding:35px;

box-shadow:0 20px 40px rgba(0,0,0,.30);

border:1px solid rgba(255,255,255,.05);

max-width:800px;

}

.form-group{

margin-bottom:22px;

}

.form-label{

display:block;

margin-bottom:8px;

font-weight:600;

color:white;

}

.form-control{

width:100%;

padding:14px;

background:#1F2937;

border:none;

border-radius:14px;

color:white;

}

.form-control:focus{

outline:none;

box-shadow:0 0 0 3px rgba(124,58,237,.35);

}

.save-btn{

background:linear-gradient(135deg,#6D28D9,#8B5CF6);

padding:14px 28px;

border:none;

border-radius:14px;

color:white;

font-weight:600;

cursor:pointer;

}

</style>

<div class="profile-card">

@if(session('status'))

<div style="background:#10B981;padding:15px;border-radius:12px;margin-bottom:25px;">

{{ session('status') }}

</div>

@endif

<form method="POST" action="{{ route('profile.update') }}">

@csrf

@method('PATCH')

<div class="form-group">

<label class="form-label">

Name

</label>

<input
type="text"
name="name"
class="form-control"
value="{{ old('name',Auth::user()->name) }}"
required>

</div>

<div class="form-group">

<label class="form-label">

Email

</label>

<input
type="email"
name="email"
class="form-control"
value="{{ old('email',Auth::user()->email) }}"
required>

</div>

<div class="form-group">

<button
type="submit"
class="save-btn">

<i class="fas fa-save"></i>

&nbsp;

Save Changes

</button>

</div>

</form>

</div>

</x-student-layout>