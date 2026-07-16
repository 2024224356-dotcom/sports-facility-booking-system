<x-admin-layout>

<x-slot name="header">

<h2 class="fw-bold text-white mb-0">

Add Operating Hour

</h2>

<p class="text-secondary mb-0">

Create a facility operating schedule

</p>

</x-slot>

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

display:inline-flex;

align-items:center;

justify-content:center;

gap:10px;

background:linear-gradient(135deg,#6D28D9,#8B5CF6);

border:none;

color:white;

padding:14px 30px;

border-radius:15px;

font-weight:600;

transition:.3s;

}

.save-btn:hover{

color:white;

transform:translateY(-2px);

box-shadow:0 10px 25px rgba(124,58,237,.35);

}

</style>

<div class="form-card">

<form action="{{ route('operating-hours.store') }}" method="POST">

@csrf

@if ($errors->any())

<div class="alert alert-danger rounded-4 border-0 mb-4">

    <ul class="mb-0">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="row">

    <div class="col-md-6 mb-4">

        <label class="form-label">

            Facility

        </label>

        <select
            name="facility_id"
            class="form-select"
            required>

            <option value="">-- Select Facility --</option>

            @foreach($facilities as $facility)

                <option
                    value="{{ $facility->id }}"
                    {{ old('facility_id') == $facility->id ? 'selected' : '' }}>

                    {{ $facility->facility_name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-6 mb-4">

        <label class="form-label">

            Day of Week

        </label>

        <select
            name="day_of_week"
            class="form-select"
            required>

            <option value="">-- Select Day --</option>

            <option value="Mon">Monday</option>
            <option value="Tue">Tuesday</option>
            <option value="Wed">Wednesday</option>
            <option value="Thu">Thursday</option>
            <option value="Fri">Friday</option>
            <option value="Sat">Saturday</option>
            <option value="Sun">Sunday</option>

        </select>

    </div>

</div>

<div class="row">

    <div class="col-md-6 mb-4">

        <label class="form-label">

            Opening Time

        </label>

        <input
            type="time"
            name="open_time"
            class="form-control"
            value="{{ old('open_time') }}"
            required>

    </div>

    <div class="col-md-6 mb-4">

        <label class="form-label">

            Closing Time

        </label>

        <input
            type="time"
            name="close_time"
            class="form-control"
            value="{{ old('close_time') }}"
            required>

    </div>

</div>

<hr class="border-secondary my-4">

<div class="d-flex justify-content-end gap-3">

    <a
        href="{{ route('operating-hours.index') }}"
        class="btn btn-secondary px-4 py-3 rounded-4">

        <i class="fas fa-times me-2"></i>

        Cancel

    </a>

    <button
        type="submit"
        class="save-btn">

        <i class="fas fa-floppy-disk me-2"></i>

        Save Operating Hour

    </button>

</div>

</form>

</div>

@if(session('success'))

<script>

Swal.fire({

icon:'success',

title:'Success',

text:'{{ session("success") }}',

background:'#111827',

color:'#fff',

confirmButtonColor:'#7C3AED',

timer:1800,

showConfirmButton:false

});

</script>

@endif

</x-admin-layout>