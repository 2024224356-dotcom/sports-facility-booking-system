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

<button class="btn-purple">

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