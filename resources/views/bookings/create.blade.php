<x-student-layout>

<x-slot name="header">

<div>

<h2 style="font-size:30px;font-weight:700;color:white;">

Book Sports Facility

</h2>

<p style="color:#94A3B8;">

Submit a new booking request

</p>

</div>

</x-slot>

<style>

.form-card{

background:#111827;

padding:30px;

border-radius:22px;

box-shadow:0 20px 40px rgba(0,0,0,.30);

border:1px solid rgba(255,255,255,.05);

}

.form-label{

display:block;

margin-bottom:8px;

font-weight:600;

color:white;

}

.form-control,

.form-select,

textarea{

width:100%;

padding:14px;

background:#1F2937;

border:none;

border-radius:14px;

color:white;

margin-bottom:20px;

}

.form-control:focus,

.form-select:focus,

textarea:focus{

outline:none;

box-shadow:0 0 0 3px rgba(124,58,237,.35);

}

.submit-btn{

background:linear-gradient(135deg,#6D28D9,#8B5CF6);

border:none;

padding:14px 30px;

border-radius:14px;

color:white;

font-weight:600;

cursor:pointer;

transition:.25s;

}

.submit-btn:hover{

transform:translateY(-3px);

}

</style>

<div class="form-card">

<form method="POST" action="{{ route('bookings.store') }}">

@csrf

<label class="form-label">

Facility

</label>

<select
name="facility_id"
class="form-select"
required>

<option value="">

Select Facility

</option>

@foreach($facilities as $facility)

<option value="{{ $facility->id }}">

{{ $facility->facility_name }}

</option>

@endforeach

</select>

<label class="form-label">

Booking Date

</label>

<input
type="date"
name="booking_date"
class="form-control"
required>

<label class="form-label">

Start Time

</label>

<input
type="time"
name="start_time"
class="form-control"
required>

<label class="form-label">

End Time

</label>

<input
type="time"
name="end_time"
class="form-control"
required>

<label class="form-label">

Purpose

</label>

<textarea
name="purpose"
rows="5"
required></textarea>

<button
type="submit"
class="submit-btn">

<i class="fas fa-calendar-check"></i>

&nbsp;

Submit Booking

</button>

</form>

</div>

</x-student-layout>