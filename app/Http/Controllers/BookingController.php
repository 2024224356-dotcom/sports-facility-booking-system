<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->role == 'student') {
            return redirect()->route('student.dashboard');
        }

        return view('dashboard', [
            'totalFacilities' => Facility::count(),
            'totalStudents' => User::where('role', 'student')->count(),
            'totalBookings' => Booking::count(),
            'pendingBookings' => Booking::where('booking_status', 'pending')->count(),
            'approvedBookings' => Booking::where('booking_status', 'approved')->count(),
            'completedBookings' => Booking::where('booking_status', 'completed')->count(),
            'rejectedBookings' => Booking::where('booking_status', 'rejected')->count(),
            'cancelledBookings' => Booking::where('booking_status', 'cancelled')->count(),
            'recentBookings' => Booking::with(['user', 'facility'])
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }

    public function studentDashboard()
    {
        return view('student.dashboard', [
            'totalBookings' => Booking::where('user_id', Auth::id())->count(),
            'pendingBookings' => Booking::where('user_id', Auth::id())
                ->where('booking_status', 'pending')
                ->count(),
            'approvedBookings' => Booking::where('user_id', Auth::id())
                ->where('booking_status', 'approved')
                ->count(),
            'recentBookings' => Booking::with('facility')
                ->where('user_id', Auth::id())
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }

    public function index()
    {
        $bookings = Booking::with(['facility', 'user'])
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $facilities = Facility::where('availability_status', 'available')
            ->orderBy('facility_name')
            ->get();

        return view('bookings.create', compact('facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'purpose' => 'required|max:500',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Booking Conflict Validation
        |--------------------------------------------------------------------------
        */

        $bookingConflict = Booking::where('facility_id', $request->facility_id)
            ->where('booking_date', $request->booking_date)
            ->whereIn('booking_status', ['pending', 'approved'])
            ->where(function ($query) use ($request) {

                $query->whereBetween('start_time', [
                    $request->start_time,
                    $request->end_time
                ])

                ->orWhereBetween('end_time', [
                    $request->start_time,
                    $request->end_time
                ])

                ->orWhere(function ($q) use ($request) {

                    $q->where('start_time', '<=', $request->start_time)
                      ->where('end_time', '>=', $request->end_time);

                });

            })
            ->exists();

        if ($bookingConflict) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'This facility has already been booked during the selected time. Please choose another available time.'
                );

        }

        Booking::create([
            'user_id' => Auth::id(),
            'facility_id' => $request->facility_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'purpose' => $request->purpose,
            'booking_status' => 'pending',
        ]);

        return redirect()
            ->route('bookings.my')
            ->with('success', 'Booking submitted successfully.');
    }

    public function myBookings()
    {
        $bookings = Booking::with('facility')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('bookings.my-bookings', compact('bookings'));
    }

    public function approve(Booking $booking)
    {
        /*
        |--------------------------------------------------------------------------
        | Prevent approving an already processed booking
        |--------------------------------------------------------------------------
        */

        if ($booking->booking_status != 'pending') {

            return back()->with(
                'error',
                'Only pending bookings can be approved.'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Double Check Booking Conflict
        |--------------------------------------------------------------------------
        */

        $conflict = Booking::where('facility_id', $booking->facility_id)
            ->where('booking_date', $booking->booking_date)
            ->where('booking_status', 'approved')
            ->where('id', '!=', $booking->id)
            ->where(function ($query) use ($booking) {

                $query->whereBetween('start_time', [
                        $booking->start_time,
                        $booking->end_time
                    ])

                    ->orWhereBetween('end_time', [
                        $booking->start_time,
                        $booking->end_time
                    ])

                    ->orWhere(function ($q) use ($booking) {

                        $q->where('start_time', '<=', $booking->start_time)
                          ->where('end_time', '>=', $booking->end_time);

                    });

            })
            ->exists();

        if ($conflict) {

            return back()->with(
                'error',
                'Another approved booking already occupies this time slot.'
            );

        }

        $booking->update([

            'booking_status' => 'approved',

            'remarks' => 'Approved by Administrator'

        ]);

        return back()->with(
            'success',
            'Booking approved successfully.'
        );
    }

    public function reject(Request $request, Booking $booking)
    {
        if ($booking->booking_status != 'pending') {

            return back()->with(
                'error',
                'Only pending bookings can be rejected.'
            );

        }

        $request->validate([

            'remarks' => 'required|max:255'

        ]);

        $booking->update([

            'booking_status' => 'rejected',

            'remarks' => $request->remarks

        ]);

        return back()->with(
            'success',
            'Booking rejected successfully.'
        );
    }

    public function complete(Booking $booking)
    {
        /*
        |--------------------------------------------------------------------------
        | Only Approved Booking Can Be Completed
        |--------------------------------------------------------------------------
        */

        if ($booking->booking_status != 'approved') {

            return back()->with(
                'error',
                'Only approved bookings can be completed.'
            );

        }

        $booking->update([

            'booking_status' => 'completed',

            'remarks' => 'Booking completed successfully.'

        ]);

        return back()->with(
            'success',
            'Booking marked as completed.'
        );
    }

    public function destroy(Booking $booking)
    {
        /*
        |--------------------------------------------------------------------------
        | Student Can Only Cancel Their Own Booking
        |--------------------------------------------------------------------------
        */

        if ($booking->user_id != Auth::id()) {

            abort(403);

        }

        /*
        |--------------------------------------------------------------------------
        | Prevent Cancelling Completed Booking
        |--------------------------------------------------------------------------
        */

        if ($booking->booking_status == 'completed') {

            return back()->with(
                'error',
                'Completed bookings cannot be cancelled.'
            );

        }

        if ($booking->booking_status == 'cancelled') {

            return back()->with(
                'error',
                'This booking has already been cancelled.'
            );

        }

        $booking->update([

            'booking_status' => 'cancelled',

            'remarks' => 'Cancelled by student.'

        ]);

        return back()->with(
            'success',
            'Booking cancelled successfully.'
        );
    }
}