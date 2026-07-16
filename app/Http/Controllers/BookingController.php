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
        if(Auth::user()->role=='student'){
            return redirect()->route('student.dashboard');
        }

        return view('dashboard',[
            'totalFacilities'=>Facility::count(),
            'totalStudents'=>User::where('role','student')->count(),
            'totalBookings'=>Booking::count(),
            'pendingBookings'=>Booking::where('booking_status','pending')->count(),
            'approvedBookings'=>Booking::where('booking_status','approved')->count(),
            'completedBookings'=>Booking::where('booking_status','completed')->count(),
            'rejectedBookings'=>Booking::where('booking_status','rejected')->count(),
            'cancelledBookings'=>Booking::where('booking_status','cancelled')->count(),
            'recentBookings'=>Booking::with(['user','facility'])->latest()->take(5)->get(),
        ]);
    }

    public function studentDashboard()
    {
        return view('student.dashboard',[
            'totalBookings'=>Booking::where('user_id',Auth::id())->count(),
            'pendingBookings'=>Booking::where('user_id',Auth::id())->where('booking_status','pending')->count(),
            'approvedBookings'=>Booking::where('user_id',Auth::id())->where('booking_status','approved')->count(),
            'recentBookings'=>Booking::with('facility')
                ->where('user_id',Auth::id())
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }

    public function index()
    {
        $bookings=Booking::with(['facility','user'])
            ->latest()
            ->paginate(10);

        return view('bookings.index',compact('bookings'));
    }

    public function create()
    {
        $facilities=Facility::where('availability_status','available')
            ->orderBy('facility_name')
            ->get();

        return view('bookings.create',compact('facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'facility_id'=>'required|exists:facilities,id',
            'booking_date'=>'required|date|after_or_equal:today',
            'start_time'=>'required',
            'end_time'=>'required|after:start_time',
            'purpose'=>'required|max:500',
        ]);

        Booking::create([
            'user_id'=>Auth::id(),
            'facility_id'=>$request->facility_id,
            'booking_date'=>$request->booking_date,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'purpose'=>$request->purpose,
            'booking_status'=>'pending',
        ]);

        return redirect()
            ->route('bookings.my')
            ->with('success','Booking submitted successfully.');
    }

    public function myBookings()
    {
        $bookings=Booking::with('facility')
            ->where('user_id',Auth::id())
            ->latest()
            ->get();

        return view('bookings.my-bookings',compact('bookings'));
    }

    public function approve(Booking $booking)
    {
        $booking->update([
            'booking_status'=>'approved',
            'remarks'=>'Approved by administrator'
        ]);

        return back()->with('success','Booking approved.');
    }

    public function reject(Request $request,Booking $booking)
    {
        $request->validate([
            'remarks'=>'required'
        ]);

        $booking->update([
            'booking_status'=>'rejected',
            'remarks'=>$request->remarks
        ]);

        return back()->with('success','Booking rejected.');
    }

    public function complete(Booking $booking)
    {
        $booking->update([
            'booking_status'=>'completed'
        ]);

        return back()->with('success','Booking completed.');
    }

    public function destroy(Booking $booking)
    {
        if($booking->user_id!=Auth::id()){
            abort(403);
        }

        $booking->update([
            'booking_status'=>'cancelled'
        ]);

        return back()->with('success','Booking cancelled.');
    }
}