<x-admin-layout>

<x-slot name="header">

<h2 class="fw-bold text-white mb-0">

Edit Facility Type

</h2>

<p class="text-secondary mb-0">

Update facility category information

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
textarea{

background:#1F2937;

border:none;

color:white;

border-radius:14px;

padding:14px;

}

.form-control:focus,
textarea:focus{

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

<a href="{{ route('facility-types.index') }}" class="back-btn">

<i class="fas fa-arrow-left"></i>

Back

</a>

</div>

<form action="{{ route('facility-types.update',$facilityType) }}" method="POST">

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

<div class="mb-4">

    <label class="form-label">

        Facility Type Name

    </label>

    <input
        type="text"
        name="type_name"
        class="form-control"
        value="{{ old('type_name',$facilityType->type_name) }}"
        required>

</div>

<div class="mb-4">

    <label class="form-label">

        Description

    </label>

    <textarea
        name="description"
        rows="5"
        class="form-control">{{ old('description',$facilityType->description) }}</textarea>

</div>

<hr class="border-secondary my-4">

<div class="d-flex justify-content-end gap-3">

    <a
        href="{{ route('facility-types.index') }}"
        class="btn btn-secondary px-4 py-3 rounded-4">

        <i class="fas fa-times me-2"></i>

        Cancel

    </a>

    <button
        type="submit"
        class="save-btn">

        <i class="fas fa-pen-to-square me-2"></i>

        Update Type

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