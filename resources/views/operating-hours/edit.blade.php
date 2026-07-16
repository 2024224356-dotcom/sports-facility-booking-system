<x-admin-layout>

<x-slot name="header">

<h2 class="fw-bold text-white mb-0">

Edit Operating Hour

</h2>

<p class="text-secondary mb-0">

Update facility operating schedule

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

<form action="{{ route('operating-hours.update',$operatingHour) }}" method="POST">

@csrf

@method('PUT')

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

            @foreach($facilities as $facility)

                <option
                    value="{{ $facility->id }}"
                    {{ old('facility_id',$operatingHour->facility_id)==$facility->id ? 'selected' : '' }}>

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

            <option value="Mon" {{ old('day_of_week',$operatingHour->day_of_week)=='Mon' ? 'selected' : '' }}>Monday</option>

            <option value="Tue" {{ old('day_of_week',$operatingHour->day_of_week)=='Tue' ? 'selected' : '' }}>Tuesday</option>

            <option value="Wed" {{ old('day_of_week',$operatingHour->day_of_week)=='Wed' ? 'selected' : '' }}>Wednesday</option>

            <option value="Thu" {{ old('day_of_week',$operatingHour->day_of_week)=='Thu' ? 'selected' : '' }}>Thursday</option>

            <option value="Fri" {{ old('day_of_week',$operatingHour->day_of_week)=='Fri' ? 'selected' : '' }}>Friday</option>

            <option value="Sat" {{ old('day_of_week',$operatingHour->day_of_week)=='Sat' ? 'selected' : '' }}>Saturday</option>

            <option value="Sun" {{ old('day_of_week',$operatingHour->day_of_week)=='Sun' ? 'selected' : '' }}>Sunday</option>

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
            value="{{ old('open_time',$operatingHour->open_time) }}"
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
            value="{{ old('close_time',$operatingHour->close_time) }}"
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

        <i class="fas fa-pen-to-square me-2"></i>

        Update Operating Hour

    </button>

</div>

</form>

</div>

@if(session('success'))

<script>

Swal.fire({

icon:'success',

title:'Updated Successfully',

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