<x-admin-layout>

<x-slot name="header">

<div class="d-flex justify-content-between align-items-center">

<div>

<h2 class="fw-bold text-white mb-0">

Operating Hours

</h2>

<p class="text-secondary mb-0">

Manage facility operating schedules

</p>

</div>

</div>

</x-slot>

<style>

.main-card{

background:#111827;

border-radius:22px;

padding:30px;

box-shadow:0 20px 45px rgba(0,0,0,.35);

}

.search-box{

background:#1F2937;

border:none;

color:white;

border-radius:14px;

padding:14px;

}

.search-box:focus{

background:#1F2937;

color:white;

box-shadow:0 0 20px rgba(124,58,237,.4);

}

.add-btn{

display:inline-flex;

align-items:center;

gap:10px;

background:linear-gradient(135deg,#6D28D9,#8B5CF6);

padding:12px 22px;

border-radius:16px;

color:white;

text-decoration:none;

font-weight:600;

transition:.3s;

}

.add-btn:hover{

color:white;

transform:translateY(-2px);

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

}

.table tbody td{

padding:18px;

background:#111827;

border-color:#1F2937;

vertical-align:middle;

}

.day-badge{

background:#7C3AED;

padding:8px 16px;

border-radius:30px;

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

</style>

<div class="main-card">

@if(session('success'))

<div class="alert alert-success rounded-4 border-0">

{{ session('success') }}

</div>

@endif

<div class="d-flex justify-content-between align-items-center mb-4">

<input

id="search"

class="form-control search-box w-50"

placeholder="Search operating hours...">

<a

href="{{ route('operating-hours.create') }}"

class="add-btn">

<i class="fas fa-plus"></i>

Add Operating Hour

</a>

</div>

<div class="table-responsive">

<table class="table align-middle" id="hourTable">

<thead>

<tr>

<th width="70">

#

</th>

<th>

Facility

</th>

<th>

Day

</th>

<th>

Open

</th>

<th>

Close

</th>

<th width="180">

Action

</th>

</tr>

</thead>

<tbody>

@forelse($hours as $hour)

<tr>

<td>

<strong>

#{{ $hour->id }}

</strong>

</td>

<td>

{{ $hour->facility->facility_name }}

</td>

<td>

<span class="day-badge">

{{ $hour->day_of_week }}

</span>

</td>

<td>

{{ \Carbon\Carbon::parse($hour->open_time)->format('g:i A') }}

</td>

<td>

{{ \Carbon\Carbon::parse($hour->close_time)->format('g:i A') }}

</td>

<td>

<a
href="{{ route('operating-hours.edit',$hour) }}"
class="action-btn edit-btn">

<i class="fas fa-pen"></i>

</a>

<form
action="{{ route('operating-hours.destroy',$hour) }}"
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

<td colspan="6" class="text-center py-5">

<i class="fas fa-clock fa-4x text-secondary mb-3"></i>

<h5 class="text-secondary">

No Operating Hours Found

</h5>

<p class="text-secondary">

Click <strong>Add Operating Hour</strong> to create your first schedule.

</p>

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

<script>

document.getElementById("search").addEventListener("keyup",function(){

let value=this.value.toLowerCase();

document.querySelectorAll("#hourTable tbody tr").forEach(function(row){

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

title:"Delete Operating Hour?",

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