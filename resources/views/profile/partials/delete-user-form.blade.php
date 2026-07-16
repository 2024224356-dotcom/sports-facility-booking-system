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

<form method="POST" action="{{ route('profile.destroy') }}">

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
class="btn btn-danger rounded-4 px-4 py-2"

onclick="return confirm('Are you sure you want to permanently delete your account?')">

<i class="fas fa-trash"></i>

&nbsp;

Delete Account

</button>

</form>

</section>