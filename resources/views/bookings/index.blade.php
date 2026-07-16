<x-admin-layout>

<x-slot name="header">

<h2 class="fw-bold text-white mb-0">

Facility Bookings

</h2>

<p class="text-secondary mb-0">

Manage all facility booking requests

</p>

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

.status{

padding:8px 14px;

border-radius:30px;

font-size:13px;

font-weight:600;

color:white;

}

.pending{

background:#F59E0B;

}

.approved{

background:#10B981;

}

.rejected{

background:#EF4444;

}

.cancelled{

background:#6B7280;

}

.completed{

background:#3B82F6;

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

placeholder="Search booking...">

<a

href="{{ route('bookings.create') }}"

class="add-btn">

<i class="fas fa-plus"></i>

New Booking

</a>

</div>

<div class="table-responsive">

<table class="table align-middle" id="bookingTable">

<thead>

<tr>

<th>#</th>

<th>Student</th>

<th>Facility</th>

<th>Date</th>

<th>Time</th>

<th>Status</th>

<th>Action</th>

</tr>

</thead>

<tbody>

@forelse($bookings as $booking)

<tr>

<td>

<strong>

#{{ $booking->id }}

</strong>

</td>

<td>

{{ $booking->user->name }}

</td>

<td>

{{ $booking->facility->facility_name }}

</td>

<td>

{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

</td>

<td>

{{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}

-

{{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}

</td>

<td>

@if($booking->booking_status=='pending')

<span class="status pending">

Pending

</span>

@elseif($booking->booking_status=='approved')

<span class="status approved">

Approved

</span>

@elseif($booking->booking_status=='rejected')

<span class="status rejected">

Rejected

</span>

@elseif($booking->booking_status=='cancelled')

<span class="status cancelled">

Cancelled

</span>

@else

<span class="status completed">

Completed

</span>

@endif

</td>

<td>

@if($booking->booking_status=='pending')

<div class="d-flex gap-2">

<form
action="{{ route('bookings.approve',$booking) }}"
method="POST"
class="approveForm">

@csrf

@method('PATCH')

<button
type="button"
class="btn btn-danger btn-sm rounded-3 rejectBooking"
data-id="{{ $booking->id }}">

<i class="fas fa-times"></i>

</button>

</form>

<button
class="btn btn-danger btn-sm rounded-3"
data-bs-toggle="modal"
data-bs-target="#reject{{ $booking->id }}">

<i class="fas fa-times"></i>

</button>

</div>

@elseif($booking->booking_status=='approved')

<form
action="{{ route('bookings.complete',$booking) }}"
method="POST"
class="completeForm">

@csrf

@method('PATCH')

<button
class="btn btn-primary btn-sm rounded-3">

<i class="fas fa-flag-checkered"></i>

Complete

</button>

</form>

@else

<span class="text-secondary">

No Action

</span>

@endif

</td>

</tr>

</tr>

@empty

<tr>

<td colspan="7" class="text-center py-5">

<i class="fas fa-calendar-xmark fa-4x text-secondary mb-3"></i>

<h5 class="text-secondary">

No Bookings Found

</h5>

<p class="text-secondary">

Click <strong>New Booking</strong> to submit your first booking request.

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

document.querySelectorAll("#bookingTable tbody tr").forEach(function(row){

row.style.display=row.innerText.toLowerCase().includes(value)

? ""

: "none";

});

});

</script>

<script>

document.querySelectorAll(".approveForm").forEach(function(form){

form.addEventListener("submit",function(e){

e.preventDefault();

Swal.fire({

title:"Approve Booking?",

text:"This booking will be approved.",

icon:"question",

background:"#111827",

color:"#fff",

confirmButtonColor:"#10B981",

cancelButtonColor:"#6B7280",

confirmButtonText:"Approve",

cancelButtonText:"Cancel",

reverseButtons:true

}).then((result)=>{

if(result.isConfirmed){

form.submit();

}

});

});

});

document.querySelectorAll(".completeForm").forEach(function(form){

form.addEventListener("submit",function(e){

e.preventDefault();

Swal.fire({

title:"Complete Booking?",

text:"Mark this booking as completed?",

icon:"question",

background:"#111827",

color:"#fff",

confirmButtonColor:"#3B82F6",

cancelButtonColor:"#6B7280",

confirmButtonText:"Complete",

cancelButtonText:"Cancel",

reverseButtons:true

}).then((result)=>{

if(result.isConfirmed){

form.submit();

}

});

});

});

document.querySelectorAll(".rejectBooking").forEach(function(button){

button.addEventListener("click",function(){

let bookingId=this.dataset.id;

Swal.fire({

title:"Reject Booking",

input:"textarea",

inputPlaceholder:"Enter rejection reason...",

icon:"warning",

background:"#111827",

color:"#fff",

showCancelButton:true,

confirmButtonText:"Reject",

confirmButtonColor:"#DC2626",

cancelButtonColor:"#6B7280",

inputValidator:(value)=>{

if(!value){

return "Reason is required.";

}

}

}).then((result)=>{

if(result.isConfirmed){

let form=document.createElement("form");

form.method="POST";

form.action="/bookings/"+bookingId+"/reject";

form.innerHTML=`

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<input type="hidden" name="_method" value="PATCH">

<input type="hidden" name="remarks" value="${result.value}">

`;

document.body.appendChild(form);

form.submit();

}

});

});

});

</script>

</x-admin-layout>