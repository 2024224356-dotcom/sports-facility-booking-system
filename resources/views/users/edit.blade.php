<x-admin-layout>

<style>

.form-card{
background:#111827;
border-radius:22px;
padding:35px;
box-shadow:0 20px 45px rgba(0,0,0,.35);
}

.form-label{
color:white;
font-weight:600;
margin-bottom:10px;
}

.form-control,
.form-select{
background:#1F2937;
border:none;
color:white;
border-radius:14px;
padding:14px;
}

.form-control:focus,
.form-select:focus{
background:#1F2937;
color:white;
box-shadow:0 0 20px rgba(124,58,237,.45);
}

.save-btn{
background:linear-gradient(135deg,#6D28D9,#8B5CF6);
border:none;
color:white;
padding:14px 30px;
border-radius:15px;
font-weight:600;
transition:.3s;
}

.save-btn:hover{
transform:translateY(-2px);
box-shadow:0 10px 25px rgba(124,58,237,.35);
color:white;
}

.note{
color:#9CA3AF;
font-size:14px;
margin-top:-10px;
margin-bottom:20px;
}

</style>

<h2 class="text-white fw-bold mb-4">

Edit User

</h2>

<div class="form-card">

<form action="{{ route('users.update',$user) }}" method="POST">

@csrf
@method('PUT')

<div class="row">

<div class="col-md-6 mb-4">

<label class="form-label">

Full Name

</label>

<input
type="text"
name="name"
class="form-control"
value="{{ old('name',$user->name) }}"
required>

</div>

<div class="col-md-6 mb-4">

<label class="form-label">

@if($user->role == 'admin')

Staff ID

@else

Student ID

@endif

</label>

<input
type="text"
name="student_id"
class="form-control"
value="{{ old('student_id',$user->student_id) }}">

</div>

<div class="col-md-6 mb-4">

<label class="form-label">

Email

</label>

<input
type="email"
name="email"
class="form-control"
value="{{ old('email',$user->email) }}"
required>

</div>

<div class="col-md-6 mb-4">

<label class="form-label">

Phone

</label>

<input
type="text"
name="phone_number"
class="form-control"
value="{{ old('phone',$user->phone) }}">

</div>

<div class="col-md-6 mb-4">

<label class="form-label">

Role

</label>

<select
name="role"
class="form-select"
required>

<option
value="student"
{{ $user->role=='student' ? 'selected' : '' }}>

Student

</option>

<option
value="admin"
{{ $user->role=='admin' ? 'selected' : '' }}>

Administrator

</option>

</select>

</div>

<div class="col-md-6 mb-4">

<label class="form-label">

New Password

</label>

<input
type="password"
name="password"
class="form-control">

<div class="note">

Leave blank to keep the current password.

</div>

</div>

<div class="col-md-6 mb-4">

<label class="form-label">

Confirm Password

</label>

<input
type="password"
name="password_confirmation"
class="form-control">

</div>

</div>

<div class="mt-4">

<button class="save-btn">

<i class="fas fa-save me-2"></i>

Update User

</button>

</div>

</form>

</div>

</x-admin-layout>