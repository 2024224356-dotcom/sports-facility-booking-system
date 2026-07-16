<x-admin-layout>

<x-slot name="header">

<div class="d-flex justify-content-between align-items-center">

<div>

<h2 class="fw-bold text-white mb-0">

Admin Dashboard

</h2>

<p class="text-secondary mb-0">

Sports Facility Booking Management System

</p>

</div>

</div>

</x-slot>

<style>

.dashboard-card{

background:rgba(255,255,255,.05);

border-radius:22px;

padding:28px;

border:1px solid rgba(255,255,255,.08);

backdrop-filter:blur(15px);

transition:.3s;

height:100%;

}

.dashboard-card:hover{

transform:translateY(-6px);

box-shadow:0 15px 35px rgba(124,58,237,.25);

}

.dashboard-icon{

width:60px;

height:60px;

border-radius:18px;

display:flex;

align-items:center;

justify-content:center;

font-size:24px;

color:white;

margin-bottom:18px;

}

.icon-purple{

background:linear-gradient(135deg,#6D28D9,#8B5CF6);

}

.icon-blue{

background:linear-gradient(135deg,#2563EB,#3B82F6);

}

.icon-green{

background:linear-gradient(135deg,#059669,#10B981);

}

.icon-orange{

background:linear-gradient(135deg,#EA580C,#F97316);

}

.icon-red{

background:linear-gradient(135deg,#DC2626,#EF4444);

}

.dashboard-number{

font-size:40px;

font-weight:700;

margin-bottom:5px;

}

.dashboard-title{

color:#94A3B8;

font-size:15px;

}

.quick-btn{

display:flex;

align-items:center;

justify-content:center;

gap:10px;

padding:16px;

border-radius:18px;

text-decoration:none;

background:#111827;

color:white;

transition:.3s;

font-weight:600;

}

.quick-btn:hover{

background:#6D28D9;

color:white;

transform:translateY(-3px);

}

</style>

<div class="container-fluid">

<div class="row g-4">

<div class="col-xl-3 col-md-6">

<div class="dashboard-card">

<div class="dashboard-icon icon-purple">

<i class="fas fa-building"></i>

</div>

<div class="dashboard-number">

{{ $totalFacilities }}

</div>

<div class="dashboard-title">

Total Facilities

</div>

</div>

</div>

<div class="col-xl-3 col-md-6">

<div class="dashboard-card">

<div class="dashboard-icon icon-blue">

<i class="fas fa-user-graduate"></i>

</div>

<div class="dashboard-number">

{{ $totalStudents }}

</div>

<div class="dashboard-title">

Total Students

</div>

</div>

</div>

<div class="col-xl-3 col-md-6">

<div class="dashboard-card">

<div class="dashboard-icon icon-green">

<i class="fas fa-calendar-check"></i>

</div>

<div class="dashboard-number">

{{ $totalBookings }}

</div>

<div class="dashboard-title">

Total Bookings

</div>

</div>

</div>

<div class="col-xl-3 col-md-6">

<div class="dashboard-card">

<div class="dashboard-icon icon-orange">

<i class="fas fa-hourglass-half"></i>

</div>

<div class="dashboard-number text-warning">

{{ $pendingBookings }}

</div>

<div class="dashboard-title">

Pending Bookings

</div>

</div>

</div>

<div class="col-xl-3 col-md-6">

<div class="dashboard-card">

<div class="dashboard-icon icon-green">

<i class="fas fa-circle-check"></i>

</div>

<div class="dashboard-number text-success">

{{ $approvedBookings }}

</div>

<div class="dashboard-title">

Approved Bookings

</div>

</div>

</div>

<div class="col-xl-3 col-md-6">

<div class="dashboard-card">

<div class="dashboard-icon icon-blue">

<i class="fas fa-flag-checkered"></i>

</div>

<div class="dashboard-number text-info">

{{ $completedBookings }}

</div>

<div class="dashboard-title">

Completed Bookings

</div>

</div>

</div>

<div class="col-xl-3 col-md-6">

<div class="dashboard-card">

<div class="dashboard-icon icon-red">

<i class="fas fa-ban"></i>

</div>

<div class="dashboard-number text-danger">

{{ $cancelledBookings }}

</div>

<div class="dashboard-title">

Cancelled Bookings

</div>

</div>

</div>

</div>

<div class="row mt-5">

<!-- Recent Bookings -->

<div class="col-lg-8 mb-4">

    <div class="dashboard-card">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="fw-bold mb-0">

                <i class="fas fa-clock me-2 text-primary"></i>

                Recent Bookings

            </h4>

            <a href="{{ route('bookings.index') }}" class="btn btn-sm btn-primary">

                View All

            </a>

        </div>

        <div class="table-responsive">

            <table class="table table-dark table-hover align-middle">

                <thead>

                    <tr>

                        <th>Student</th>

                        <th>Facility</th>

                        <th>Date</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($recentBookings as $booking)

                    <tr>

                        <td>{{ $booking->user->name }}</td>

                        <td>{{ $booking->facility->facility_name }}</td>

                        <td>{{ $booking->booking_date }}</td>

                        <td>

                            @if($booking->booking_status == 'pending')

                                <span class="badge bg-warning">

                                    Pending

                                </span>

                            @elseif($booking->booking_status == 'approved')

                                <span class="badge bg-success">

                                    Approved

                                </span>

                            @elseif($booking->booking_status == 'completed')

                                <span class="badge bg-info">

                                    Completed

                                </span>

                            @elseif($booking->booking_status == 'rejected')

                                <span class="badge bg-danger">

                                    Rejected

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    Cancelled

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center">

                            No recent bookings found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- Quick Actions -->

<div class="col-lg-4">

    <div class="dashboard-card">

        <h4 class="fw-bold mb-4">

            <i class="fas fa-bolt text-warning me-2"></i>

            Quick Actions

        </h4>

        <div class="d-grid gap-3">

            <a href="{{ route('facilities.create') }}" class="quick-btn">

                <i class="fas fa-plus-circle"></i>

                Add Facility

            </a>

            <a href="{{ route('facility-types.create') }}" class="quick-btn">

                <i class="fas fa-layer-group"></i>

                Add Facility Type

            </a>

            <a href="{{ route('operating-hours.create') }}" class="quick-btn">

                <i class="fas fa-clock"></i>

                Add Operating Hour

            </a>

            <a href="{{ route('facility-features.create') }}" class="quick-btn">

                <i class="fas fa-star"></i>

                Add Feature

            </a>

            <a href="{{ route('bookings.index') }}" class="quick-btn">

                <i class="fas fa-calendar-check"></i>

                Manage Bookings

            </a>

        </div>

    </div>

</div>

</div>

</div>

</x-admin-layout>