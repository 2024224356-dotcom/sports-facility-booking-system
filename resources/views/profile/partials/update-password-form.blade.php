<section>

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
required>

@error('current_password', 'updatePassword')

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
required>

@error('password', 'updatePassword')

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