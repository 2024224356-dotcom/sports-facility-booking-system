<x-admin-layout>

<x-slot name="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold text-white mb-0">
                Sports Facilities
            </h3>
            <small class="text-secondary">
                Manage all sports facilities
            </small>
        </div>
    </div>
</x-slot>

<style>

body{
background:#0B1020;
}

.main-card{

background:#111827;

border-radius:22px;

border:none;

box-shadow:0 20px 40px rgba(0,0,0,.25);

}

.btn-add{

display:inline-flex;

align-items:center;

justify-content:center;

gap:10px;

background:linear-gradient(135deg,#6D28D9,#8B5CF6);

color:#fff;

padding:14px 28px;

border-radius:16px;

font-weight:600;

font-size:18px;

line-height:1;

text-decoration:none;

transition:.3s;

box-shadow:0 10px 25px rgba(124,58,237,.35);

}

.btn-add:hover{

transform:translateY(-3px);

color:#fff;

box-shadow:0 15px 35px rgba(124,58,237,.45);

}

.btn-add i{

display:flex;

align-items:center;

justify-content:center;

font-size:20px;

line-height:1;

margin:0;

padding:0;

}

.btn-add:hover{

transform:translateY(-3px);

color:white;

box-shadow:0 15px 30px rgba(124,58,237,.4);

}

.search-box{

background:#1F2937;

border:none;

color:white;

border-radius:14px;

padding:14px 18px;

}

.search-box:focus{

background:#1F2937;

color:white;

box-shadow:0 0 18px rgba(124,58,237,.45);

}

.table{

color:white;

margin-bottom:0;

}

.table thead{

background:#1E293B;

}

.table thead th{

padding:18px;

border:none;

font-weight:600;

}

.table tbody td{

padding:18px;

background:#111827;

border-color:#1F2937;

vertical-align:middle;

}

.table tbody tr{

transition:.25s;

}

.table tbody tr:hover{

background:#1A2335;

}

.facility-icon{

width:50px;

height:50px;

border-radius:15px;

background:linear-gradient(135deg,#6D28D9,#8B5CF6);

display:flex;

align-items:center;

justify-content:center;

margin-right:15px;

}

.status-available{

background:#10B981;

padding:7px 16px;

border-radius:30px;

font-size:13px;

}

.status-maintenance{

background:#EF4444;

padding:7px 16px;

border-radius:30px;

font-size:13px;

}

.action-btn{

width:40px;

height:40px;

display:inline-flex;

align-items:center;

justify-content:center;

border-radius:12px;

text-decoration:none;

margin-right:6px;

transition:.3s;

}

.edit-btn{

background:#F59E0B;

color:white;

}

.delete-btn{

background:#DC2626;

color:white;

border:none;

}

.action-btn:hover{

transform:translateY(-2px);

color:white;

}

.btn-add .icon{

width:40px;

height:40px;

border-radius:50%;

background:white;

color:#7C3AED;

display:flex;

align-items:center;

justify-content:center;

font-size:18px;

flex-shrink:0;

}

</style>

<div class="container-fluid">

@if(session('success'))

<div class="alert alert-success border-0 rounded-4">

{{ session('success') }}

</div>

@endif

<div class="main-card p-4">

<div class="row mb-4">

<div class="col-md-5">

<input
id="search"
class="form-control search-box"
placeholder="Search facility...">

</div>

</div>

<div class="table-responsive">

<table
class="table align-middle"
id="facilityTable">

<thead>

<tr>

<th width="70">

#

</th>

<th>

Facility

</th>

<th>

Type

</th>

<th>

Status

</th>

<th width="170">

Action

</th>

</tr>

</thead>

<tbody>

@forelse($facilities as $facility)

<tr>

<td>

<span class="fw-bold">

#{{ $facility->id }}

</span>

</td>

<td>

<div class="d-flex align-items-center">

<div class="facility-icon">

<i class="fas fa-building text-white"></i>

</div>

<div>

<div class="fw-bold">

{{ $facility->facility_name }}

</div>

<small class="text-secondary">

Sports Facility

</small>

</div>

</div>

</td>

<td>

<span class="badge bg-primary rounded-pill px-3 py-2">

{{ $facility->facilityType->type_name }}

</span>

</td>

<td>

@if($facility->availability_status=="available")

<span class="status-available">

<i class="fas fa-circle-check me-1"></i>

Available

</span>

@else

<span class="status-maintenance">

<i class="fas fa-screwdriver-wrench me-1"></i>

Maintenance

</span>

@endif

</td>

<td>

<a
href="{{ route('facilities.edit',$facility) }}"
class="action-btn edit-btn">

<i class="fas fa-pen"></i>

</a>

<form
action="{{ route('facilities.destroy',$facility) }}"
method="POST"
class="deleteForm d-inline">

@csrf

@method('DELETE')

<button
type="submit"
class="action-btn delete-btn">

<i class="fas fa-trash"></i>

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="5" class="text-center py-5">

<i class="fas fa-building fa-4x text-secondary mb-3"></i>

<h5 class="text-secondary">

No Facilities Available

</h5>

<p class="text-secondary">

Click the <strong>Add Facility</strong> button to create your first facility.

</p>

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

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

<script>

document.getElementById("search").addEventListener("keyup",function(){

let value=this.value.toLowerCase();

document.querySelectorAll("#facilityTable tbody tr").forEach(function(row){

row.style.display=row.innerText.toLowerCase().includes(value)

? ""

: "none";

});

});

</script>

<script>

document.querySelectorAll(".deleteForm").forEach(function(form){

form.addEventListener("submit",function(e){

e.preventDefault();

Swal.fire({

title:"Delete Facility?",

text:"This action cannot be undone.",

icon:"warning",

background:"#111827",

color:"#fff",

confirmButtonColor:"#DC2626",

cancelButtonColor:"#6B7280",

confirmButtonText:"Delete",

cancelButtonText:"Cancel",

reverseButtons:true

}).then((result)=>{

if(result.isConfirmed){

form.submit();

}

});

});

});

</script>

</x-admin-layout>