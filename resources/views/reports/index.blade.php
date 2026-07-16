<x-admin-layout>

<style>

.page-title{
font-size:32px;
font-weight:700;
color:white;
margin-bottom:0;
}

.page-subtitle{
color:#94A3B8;
margin-top:6px;
}

.card-box,
.chart-card,
.filter-card,
.table-card{
background:#111827;
border-radius:22px;
padding:25px;
box-shadow:0 20px 45px rgba(0,0,0,.35);
margin-bottom:25px;
}

.stat-card{
background:#1F2937;
border-radius:20px;
padding:22px;
transition:.3s;
height:100%;
}

.stat-card:hover{
transform:translateY(-6px);
box-shadow:0 15px 30px rgba(124,58,237,.35);
}

.stat-title{
font-size:14px;
color:#9CA3AF;
margin-bottom:10px;
}

.stat-value{
font-size:34px;
font-weight:700;
margin:0;
}

.btn-purple{
background:linear-gradient(135deg,#6D28D9,#8B5CF6);
border:none;
border-radius:14px;
padding:12px 24px;
color:white;
font-weight:600;
text-decoration:none;
display:inline-flex;
align-items:center;
gap:10px;
transition:.3s;
}

.btn-purple:hover{
transform:translateY(-2px);
color:white;
box-shadow:0 10px 25px rgba(124,58,237,.35);
}

.btn-grey{
background:#374151;
border:none;
border-radius:14px;
padding:12px 24px;
color:white;
font-weight:600;
text-decoration:none;
display:inline-flex;
align-items:center;
gap:10px;
}

.btn-grey:hover{
background:#4B5563;
color:white;
}

.form-control,
.form-select{
background:#1F2937;
border:none;
color:white;
border-radius:14px;
padding:13px;
}

.form-control:focus,
.form-select:focus{
background:#1F2937;
color:white;
box-shadow:0 0 20px rgba(124,58,237,.35);
}

.form-label{
color:white;
font-weight:600;
margin-bottom:10px;
}

.table{
color:white;
margin-bottom:0;
}

.table thead{
background:#1F2937;
}

.table tbody td{
background:#111827;
vertical-align:middle;
}

.badge-status{
padding:8px 16px;
border-radius:30px;
font-size:12px;
font-weight:600;
}

.pending{background:#F59E0B;}
.approved{background:#10B981;}
.completed{background:#3B82F6;}
.rejected{background:#EF4444;}
.cancelled{background:#6B7280;}

</style>

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="page-title">

Booking Reports

</h2>

<p class="page-subtitle">

Sports Facility Booking Analytics Dashboard

</p>

</div>

<div class="d-flex gap-2">

<a
href="{{ route('reports.pdf',request()->query()) }}"
class="btn-purple">

<i class="fas fa-file-pdf"></i>

Export PDF

</a>

<a
href="{{ route('reports.excel',request()->query()) }}"
class="btn-purple">

<i class="fas fa-file-excel"></i>

Export Excel

</a>

<button
onclick="window.print()"
class="btn-grey">

<i class="fas fa-print"></i>

Print

</button>

</div>

</div>

<div class="row mb-4">

<div class="col-lg-2 col-md-4 col-6 mb-3">

<div class="stat-card">

<div class="stat-title">

Total Bookings

</div>

<h2 class="stat-value text-white">

{{ $totalBookings }}

</h2>

</div>

</div>

<div class="col-lg-2 col-md-4 col-6 mb-3">

<div class="stat-card">

<div class="stat-title">

Pending

</div>

<h2 class="stat-value text-warning">

{{ $pendingBookings }}

</h2>

</div>

</div>

<div class="col-lg-2 col-md-4 col-6 mb-3">

<div class="stat-card">

<div class="stat-title">

Approved

</div>

<h2 class="stat-value text-success">

{{ $approvedBookings }}

</h2>

</div>

</div>

<div class="col-lg-2 col-md-4 col-6 mb-3">

<div class="stat-card">

<div class="stat-title">

Completed

</div>

<h2 class="stat-value text-info">

{{ $completedBookings }}

</h2>

</div>

</div>

<div class="col-lg-2 col-md-4 col-6 mb-3">

<div class="stat-card">

<div class="stat-title">

Rejected

</div>

<h2 class="stat-value text-danger">

{{ $rejectedBookings }}

</h2>

</div>

</div>

<div class="col-lg-2 col-md-4 col-6 mb-3">

<div class="stat-card">

<div class="stat-title">

Cancelled

</div>

<h2 class="stat-value text-secondary">

{{ $cancelledBookings }}

</h2>

</div>

</div>

</div>

<div class="chart-card">

<h4 class="text-white mb-4">

Monthly Booking Statistics

</h4>

<canvas id="bookingChart" height="90"></canvas>

</div>

<div class="filter-card">

<form method="GET">

<div class="row">

<div class="col-lg-3 mb-3">

<label class="form-label">

Date From

</label>

<input
type="date"
name="date_from"
value="{{ request('date_from') }}"
class="form-control">

</div>

<div class="col-lg-3 mb-3">

<label class="form-label">

Date To

</label>

<input
type="date"
name="date_to"
value="{{ request('date_to') }}"
class="form-control">

</div>

<div class="col-lg-3 mb-3">

<label class="form-label">

Facility

</label>

<select
name="facility"
class="form-select">

<option value="">

All Facilities

</option>

@foreach($facilities as $facility)

<option
value="{{ $facility->id }}"
{{ request('facility')==$facility->id?'selected':'' }}>

{{ $facility->facility_name }}

</option>

@endforeach

</select>

</div>

<div class="col-lg-3 mb-3">

<label class="form-label">

Student

</label>

<select
name="student"
class="form-select">

<option value="">

All Students

</option>

@foreach($students as $student)

<option
value="{{ $student->id }}"
{{ request('student')==$student->id?'selected':'' }}>

{{ $student->name }}

</option>

@endforeach

</select>

</div>

<div class="col-lg-3 mb-3">

<label class="form-label">

Status

</label>

<select
name="status"
class="form-select">

<option value="">All Status</option>

<option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>

<option value="approved" {{ request('status')=='approved'?'selected':'' }}>Approved</option>

<option value="completed" {{ request('status')=='completed'?'selected':'' }}>Completed</option>

<option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>

<option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>Cancelled</option>

</select>

</div>

<div class="col-12 mt-3">

<button class="btn-purple">

<i class="fas fa-search"></i>

Generate Report

</button>

<a
href="{{ route('reports.index') }}"
class="btn-grey ms-2">

<i class="fas fa-rotate-left"></i>

Reset

</a>

</div>

</div>

</form>

</div>

<div class="table-card">

<div class="table-responsive">

<table class="table">

<thead>

<tr>

<th>Student</th>

<th>Facility</th>

<th>Date</th>

<th>Time</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@forelse($bookings as $booking)

<tr>

<td>

<div class="d-flex align-items-center">

<div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-3"
style="width:42px;height:42px;font-weight:700;">

{{ strtoupper(substr($booking->user->name,0,1)) }}

</div>

<div>

<strong>

{{ $booking->user->name }}

</strong>

<br>

<small class="text-secondary">

{{ $booking->user->email }}

</small>

</div>

</div>

</td>

<td>

<strong>

{{ $booking->facility->facility_name }}

</strong>

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

<span class="badge-status {{ $booking->booking_status }}">

{{ ucfirst($booking->booking_status) }}

</span>

</td>

</tr>

@empty

<tr>

<td colspan="5" class="text-center py-5">

<i class="fas fa-folder-open fa-4x text-secondary mb-3"></i>

<h4 class="text-secondary">

No Booking Records

</h4>

<p class="text-secondary">

There are no booking records matching the selected filters.

</p>

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-4">

{{ $bookings->links() }}

</div>

</div>

<script>

const bookingChart=document.getElementById("bookingChart");

if(bookingChart){

new Chart(bookingChart,{

type:"bar",

data:{

labels:[

"Jan",

"Feb",

"Mar",

"Apr",

"May",

"Jun",

"Jul",

"Aug",

"Sep",

"Oct",

"Nov",

"Dec"

],

datasets:[{

label:"Bookings",

data: @json($chartData),

backgroundColor:[

"#7C3AED",

"#8B5CF6",

"#6366F1",

"#3B82F6",

"#10B981",

"#22C55E",

"#F59E0B",

"#F97316",

"#EF4444",

"#EC4899",

"#14B8A6",

"#06B6D4"

],

borderRadius:12,

borderSkipped:false

}]
borderRadius:12,

borderSkipped:false

}]

},

options:{

responsive:true,

maintainAspectRatio:false,

plugins:{

legend:{

labels:{

color:"#fff",

font:{

size:14,

weight:"bold"

}

}

}

},

scales:{

x:{

ticks:{

color:"#CBD5E1"

},

grid:{

display:false

}

},

y:{

beginAtZero:true,

ticks:{

color:"#CBD5E1"

},

grid:{

color:"rgba(255,255,255,.08)"

}

}

}

}

});

}

</script>

</x-admin-layout>