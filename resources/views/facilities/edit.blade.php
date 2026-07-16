<x-admin-layout>

<x-slot name="header">

<h2 class="fw-bold text-white mb-0">

Edit Facility

</h2>

<p class="text-secondary mb-0">

Update sports facility information

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

color:#fff;

font-weight:600;

margin-bottom:10px;

}

.form-control,
.form-select{

background:#1F2937;

border:none;

color:#fff;

border-radius:14px;

padding:14px;

}

.form-control:focus,
.form-select:focus{

background:#1F2937;

color:#fff;

box-shadow:0 0 20px rgba(124,58,237,.45);

}

.save-btn{

display:inline-flex;

align-items:center;

justify-content:center;

gap:10px;

background:linear-gradient(135deg,#6D28D9,#8B5CF6);

border:none;

color:#fff;

padding:14px 30px;

border-radius:15px;

font-weight:600;

transition:.3s;

}

.save-btn:hover{

color:#fff;

transform:translateY(-2px);

box-shadow:0 10px 25px rgba(124,58,237,.35);

}

.back-btn{

display:inline-flex;

align-items:center;

justify-content:center;

gap:10px;

background:#6B7280;

color:white;

padding:12px 22px;

border-radius:14px;

text-decoration:none;

font-weight:600;

transition:.3s;

}

.back-btn:hover{

background:#4B5563;

color:white;

}

</style>

<div class="form-card">

<div class="d-flex justify-content-end mb-4">

<a href="{{ route('facilities.index') }}" class="back-btn">

<i class="fas fa-arrow-left"></i>

Back

</a>

</div>

<form action="{{ route('facilities.update',$facility) }}" method="POST">

@csrf

@method('PUT')

@if ($errors->any())

<div class="alert alert-danger rounded-4 border-0 mb-4">

    <ul class="mb-0">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="row">

    <div class="col-md-6 mb-4">

        <label class="form-label">

            Facility Name

        </label>

        <input
            type="text"
            name="facility_name"
            class="form-control"
            value="{{ old('facility_name',$facility->facility_name) }}"
            required>

    </div>

    <div class="col-md-6 mb-4">

        <label class="form-label">

            Facility Type

        </label>

        <select
            name="facility_type_id"
            class="form-select"
            required>

            @foreach($facilityTypes as $type)

                <option
                    value="{{ $type->id }}"
                    {{ old('facility_type_id',$facility->facility_type_id)==$type->id ? 'selected' : '' }}>

                    {{ $type->type_name }}

                </option>

            @endforeach

        </select>

    </div>

</div>

<div class="row">

    <div class="col-md-6 mb-4">

        <label class="form-label">

            Availability Status

        </label>

        <select
            name="availability_status"
            class="form-select"
            required>

            <option
                value="available"
                {{ old('availability_status',$facility->availability_status)=='available' ? 'selected' : '' }}>

                Available

            </option>

            <option
                value="maintenance"
                {{ old('availability_status',$facility->availability_status)=='maintenance' ? 'selected' : '' }}>

                Under Maintenance

            </option>

        </select>

    </div>

</div>

<hr class="border-secondary my-4">

<div class="d-flex justify-content-end gap-3">

    <a href="{{ route('facilities.index') }}"
       class="btn btn-secondary px-4 py-3 rounded-4">

        <i class="fas fa-times me-2"></i>

        Cancel

    </a>

    <button
        type="submit"
        class="save-btn">

        <i class="fas fa-floppy-disk me-2"></i>

        Update Facility

    </button>

</div>

</form>

</div>

@if(session('success'))

<script>

Swal.fire({

icon:'success',

title:'Updated!',

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