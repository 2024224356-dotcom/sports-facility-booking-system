<x-student-layout>

<x-slot name="header">

<div>

<h2 style="font-size:30px;font-weight:700;color:white;">

My Bookings

</h2>

<p style="color:#94A3B8;">

View all your facility bookings

</p>

</div>

</x-slot>

<style>

.table-card{

background:#111827;

border-radius:22px;

padding:25px;

box-shadow:0 20px 40px rgba(0,0,0,.30);

border:1px solid rgba(255,255,255,.05);

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

padding:8px 15px;

border-radius:30px;

font-size:12px;

font-weight:600;

}

.pending{background:#F59E0B;}
.approved{background:#10B981;}
.completed{background:#3B82F6;}
.rejected{background:#EF4444;}
.cancelled{background:#6B7280;}

.action-btn{

padding:8px 15px;

border:none;

border-radius:10px;

background:#DC2626;

color:white;

font-size:13px;

cursor:pointer;

}

</style>

<div class="table-card">

<div style="overflow-x:auto;">

<table class="table">

<thead>

<tr>

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

<span class="badge {{ $booking->booking_status }}">

{{ ucfirst($booking->booking_status) }}

</span>

</td>

<td>

@if($booking->booking_status=='pending')

<form method="POST"

action="{{ route('bookings.destroy',$booking->id) }}">

@csrf

@method('DELETE')

<button class="action-btn">

Cancel

</button>

</form>

@else

-

@endif

</td>

</tr>

@empty

<tr>

<td colspan="5"

style="text-align:center;padding:40px;">

No bookings found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</x-student-layout>