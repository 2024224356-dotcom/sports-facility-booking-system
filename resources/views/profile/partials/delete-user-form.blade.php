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

.btn-danger-custom{

background:#DC2626;

border:none;

padding:12px 24px;

border-radius:12px;

color:white;

font-weight:600;

transition:.3s;

}

.btn-danger-custom:hover{

background:#B91C1C;

color:white;

transform:translateY(-2px);

}

</style>

<section>

<div class="alert alert-danger rounded-4 mb-4">

<h4 class="mb-2">

<i class="fas fa-triangle-exclamation"></i>

Danger Zone

</h4>

<p class="mb-0">

Deleting your account is permanent. All bookings and profile information will be removed permanently.

</p>

</div>

<form
method="POST"
action="{{ route('profile.destroy') }}"
class="deleteAccountForm">

@csrf

@method('DELETE')

<div class="mb-4">

<label class="form-label text-white">

Confirm Password

</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Enter your password"
required>

@error('password','userDeletion')

<small class="text-danger">

{{ $message }}

</small>

@enderror

</div>

<button
type="submit"
class="btn-danger-custom">

<i class="fas fa-trash"></i>

&nbsp;

Delete Account

</button>

</form>

</section>

<script>

document.querySelector(".deleteAccountForm").addEventListener("submit",function(e){

e.preventDefault();

Swal.fire({

title:"Delete Account?",

text:"This action cannot be undone.",

icon:"warning",

background:"#111827",

color:"#fff",

showCancelButton:true,

confirmButtonColor:"#DC2626",

cancelButtonColor:"#6B7280",

confirmButtonText:"Delete",

cancelButtonText:"Cancel",

reverseButtons:true

}).then((result)=>{

if(result.isConfirmed){

this.submit();

}

});

});

</script>

</section>