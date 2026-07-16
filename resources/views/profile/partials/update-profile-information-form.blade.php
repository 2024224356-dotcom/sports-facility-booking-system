<section>

<form method="POST" action="{{ route('profile.update') }}">

@csrf

@method('PATCH')

<div class="row">

<div class="col-md-6 mb-4">

<label class="form-label text-white">

Full Name

</label>

<input
type="text"
name="name"
value="{{ old('name',$user->name) }}"
class="form-control"
required>

@error('name')

<small class="text-danger">

{{ $message }}

</small>

@enderror

</div>

<div class="col-md-6 mb-4">

<label class="form-label text-white">

Email Address

</label>

<input
type="email"
name="email"
value="{{ old('email',$user->email) }}"
class="form-control"
required>

@error('email')

<small class="text-danger">

{{ $message }}

</small>

@enderror

</div>

</div>

<div class="mt-3">

<button
class="btn-purple">

<i class="fas fa-save"></i>

&nbsp;

Save Changes

</button>

@if(session('status')==='profile-updated')

<span class="ms-3 text-success">

Profile updated successfully.

</span>

@endif

</div>

</form>

</section>