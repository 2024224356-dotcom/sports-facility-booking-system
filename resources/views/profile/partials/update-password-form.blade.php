<section>

<style>

.form-control{

background:#1F2937 !important;

border:1px solid #374151 !important;

color:#fff !important;

border-radius:12px;

padding:12px 15px;

}

.form-control:focus{

background:#1F2937 !important;

color:#fff !important;

border-color:#7C3AED !important;

box-shadow:0 0 0 .2rem rgba(124,58,237,.25) !important;

}

.form-control::placeholder{

color:#9CA3AF !important;

}

.btn-purple{

background:linear-gradient(135deg,#6D28D9,#8B5CF6);

border:none;

padding:12px 24px;

border-radius:12px;

color:#fff;

font-weight:600;

transition:.3s;

}

.btn-purple:hover{

transform:translateY(-2px);

color:#fff;

}

</style>

<form method="POST" action="{{ route('password.update') }}">

@csrf

@method('PUT')

<div class="row">

<div class="col-md-4 mb-4">

<label class="form-label text-white">

Current Password

</label>

<input
type="password"
name="current_password"
class="form-control"
autocomplete="current-password"
required>

@error('current_password','updatePassword')

<small class="text-danger">

{{ $message }}

</small>

@enderror

</div>

<div class="col-md-4 mb-4">

<label class="form-label text-white">

New Password

</label>

<input
type="password"
name="password"
class="form-control"
autocomplete="new-password"
required>

@error('password','updatePassword')

<small class="text-danger">

{{ $message }}

</small>

@enderror

</div>

<div class="col-md-4 mb-4">

<label class="form-label text-white">

Confirm Password

</label>

<input
type="password"
name="password_confirmation"
class="form-control"
autocomplete="new-password"
required>

</div>

</div>

<div class="mt-3">

<button class="btn-purple">

<i class="fas fa-key"></i>

&nbsp;

Update Password

</button>

@if(session('status')==='password-updated')

<span class="ms-3 text-success">

Password updated successfully.

</span>

@endif

</div>

</form>

</section>