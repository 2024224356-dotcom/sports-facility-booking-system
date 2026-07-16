<x-admin-layout>

<x-slot name="header">

<h2 class="fw-bold text-white mb-0">
Edit Facility Feature
</h2>

<p class="text-secondary mb-0">
Update facility feature information
</p>

</x-slot>

<style>

.form-card{

background:#111827;

padding:35px;

border-radius:22px;

box-shadow:0 20px 45px rgba(0,0,0,.35);

max-width:800px;

margin:auto;

}

.form-label{

color:white;

font-weight:600;

margin-bottom:8px;

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

box-shadow:0 0 18px rgba(124,58,237,.45);

}

.btn-update{

background:linear-gradient(135deg,#2563EB,#3B82F6);

border:none;

padding:12px 28px;

border-radius:14px;

color:white;

font-weight:600;

}

.btn-cancel{

background:#374151;

border:none;

padding:12px 28px;

border-radius:14px;

color:white;

text-decoration:none;

margin-left:10px;

}

</style>

<div class="form-card">

<form action="{{ route('facility-features.update',$facilityFeature) }}" method="POST">

@csrf
@method('PUT')

<div class="mb-4">

<label class="form-label">
Facility
</label>

<select
name="facility_id"
class="form-select"
required>

@foreach($facilities as $facility)

<option
value="{{ $facility->id }}"
{{ old('facility_id',$facilityFeature->facility_id)==$facility->id ? 'selected' : '' }}>

{{ $facility->facility_name }}

</option>

@endforeach

</select>

@error('facility_id')

<div class="text-danger mt-2">
{{ $message }}
</div>

@enderror

</div>

<div class="mb-4">

<label class="form-label">
Feature Name
</label>

<input
type="text"
name="feature_name"
class="form-control"
value="{{ old('feature_name',$facilityFeature->feature_name) }}"
required>

@error('feature_name')

<div class="text-danger mt-2">
{{ $message }}
</div>

@enderror

</div>

<div class="mb-4">

<label class="form-label">
Description
</label>

<textarea
name="description"
rows="4"
class="form-control">{{ old('description',$facilityFeature->description) }}</textarea>

@error('description')

<div class="text-danger mt-2">
{{ $message }}
</div>

@enderror

</div>

<button
type="submit"
class="btn-update">

<i class="fas fa-save"></i>

Update Feature

</button>

<a
href="{{ route('facility-features.index') }}"
class="btn-cancel">

<i class="fas fa-arrow-left"></i>

Back

</a>

</form>

</div>

</x-admin-layout>