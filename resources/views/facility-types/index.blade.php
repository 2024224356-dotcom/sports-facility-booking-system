<x-admin-layout>

<x-slot name="header">

<div class="d-flex justify-content-between align-items-center">

<div>

<h2 class="fw-bold text-white mb-0">

Facility Types

</h2>

<p class="text-secondary mb-0">

Manage all facility categories

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

border:none;

padding:18px;

}

.table tbody td{

padding:18px;

background:#111827;

border-color:#1F2937;

vertical-align:middle;

}

.badge-purple{

background:#7C3AED;

padding:8px 15px;

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

placeholder="Search facility type...">

<a

href="{{ route('facility-types.create') }}"

class="add-btn">

<i class="fas fa-plus"></i>

Add Type

</a>

</div>

<div class="table-responsive">

<table class="table align-middle" id="typeTable">

<thead>

<tr>

<th width="70">

#

</th>

<th>

Type Name

</th>

<th>

Description

</th>

<th width="180">

Action

</th>

</tr>

</thead>

<tbody>

@forelse($types as $type)

<tr>

<td>

<strong>

#{{ $type->id }}

</strong>

</td>

<td>

<span class="badge badge-purple">

{{ $type->type_name }}

</span>

</td>

<td>

{{ $type->description ?? '-' }}

</td>

<td>

<a
href="{{ route('facility-types.edit',$type) }}"
class="action-btn edit-btn">

<i class="fas fa-pen"></i>

</a>

<form
action="{{ route('facility-types.destroy',$type) }}"
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

<td colspan="4" class="text-center py-5">

<i class="fas fa-layer-group fa-4x text-secondary mb-3"></i>

<h5 class="text-secondary">

No Facility Types Found

</h5>

<p class="text-secondary">

Click <strong>Add Type</strong> to create your first facility type.

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

document.querySelectorAll("#typeTable tbody tr").forEach(function(row){

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

title:"Delete Facility Type?",

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