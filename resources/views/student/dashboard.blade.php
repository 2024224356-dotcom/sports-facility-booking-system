<x-student-layout>

<x-slot name="header">

<div>

<h2 style="font-size:30px;font-weight:700;color:white;">

Student Dashboard

</h2>

<p style="color:#94A3B8;margin-top:5px;">

Welcome back, {{ Auth::user()->name }}

</p>

</div>

</x-slot>

<style>

.stat-card{

background:#111827;

border-radius:22px;

padding:25px;

box-shadow:0 20px 40px rgba(0,0,0,.30);

transition:.25s;

border:1px solid rgba(255,255,255,.05);

height:100%;

}

.stat-card:hover{

transform:translateY(-5px);

}

.stat-title{

font-size:14px;

color:#94A3B8;

margin-bottom:12px;

}

.stat-value{

font-size:40px;

font-weight:700;

margin:0;

}

.table-card{

background:#111827;

border-radius:22px;

padding:25px;

margin-top:35px;

border:1px solid rgba(255,255,255,.05);

box-shadow:0 20px 40px rgba(0,0,0,.30);

}

.table{

width:100%;

color:white;

border-collapse:collapse;

}

.table thead{

background:#1F2937;

}

.table th,

.table td{

padding:16px;

text-align:left;

}

.badge{

padding:8px 16px;

border-radius:30px;

font-size:12px;

font-weight:600;

display:inline-block;

}

.pending{

background:#F59E0B;

}

.approved{

background:#10B981;

}

.completed{

background:#3B82F6;

}

.rejected{

background:#EF4444;

}

.cancelled{

background:#6B7280;

}

</style>

<div class="row">

<div class="col-lg-4 mb-4">

<div class="stat-card">

<div class="stat-title">

Total Bookings

</div>

<h1 class="stat-value">

{{ $totalBookings }}

</h1>

</div>

</div>

<div class="col-lg-4 mb-4">

<div class="stat-card">

<div class="stat-title">

Pending

</div>

<h1 class="stat-value" style="color:#F59E0B;">

{{ $pendingBookings }}

</h1>

</div>

</div>

<div class="col-lg-4 mb-4">

<div class="stat-card">

<div class="stat-title">

Approved

</div>

<h1 class="stat-value" style="color:#10B981;">

{{ $approvedBookings }}

</h1>

</div>

</div>

</div>

<div class="table-card">

<h3 style="margin-bottom:20px;">

Recent Bookings

</h3>

<div style="overflow-x:auto;">

<table class="table">

<thead>

<tr>

<th>Facility</th>

<th>Date</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@forelse($recentBookings as $booking)

<tr>

<td>

{{ $booking->facility->facility_name }}

</td>

<td>

{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

</td>

<td>

<span class="badge {{ $booking->booking_status }}">

{{ ucfirst($booking->booking_status) }}

</span>

</td>

</tr>

@empty

<tr>

<td colspan="3" style="text-align:center;padding:40px;">

No bookings yet.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</x-student-layout>