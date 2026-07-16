<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user','facility']);

        if($request->filled('date_from')){
            $query->whereDate('booking_date','>=',$request->date_from);
        }

        if($request->filled('date_to')){
            $query->whereDate('booking_date','<=',$request->date_to);
        }

        if($request->filled('facility')){
            $query->where('facility_id',$request->facility);
        }

        if($request->filled('student')){
            $query->where('user_id',$request->student);
        }

        if($request->filled('status')){
            $query->where('booking_status',$request->status);
        }

        $bookings=$query->latest()->paginate(10)->withQueryString();

        $chartData=[];

        for($i=1;$i<=12;$i++){

            $chartData[]=Booking::whereMonth('booking_date',$i)->count();

        }

        return view('reports.index',[

            'bookings'=>$bookings,

            'facilities'=>Facility::orderBy('facility_name')->get(),

            'students'=>User::where('role','student')->orderBy('name')->get(),

            'totalBookings'=>Booking::count(),

            'pendingBookings'=>Booking::where('booking_status','pending')->count(),

            'approvedBookings'=>Booking::where('booking_status','approved')->count(),

            'completedBookings'=>Booking::where('booking_status','completed')->count(),

            'rejectedBookings'=>Booking::where('booking_status','rejected')->count(),

            'cancelledBookings'=>Booking::where('booking_status','cancelled')->count(),

            'chartData'=>$chartData,

        ]);
    }

    public function exportPdf()
    {
        return back()->with('success','PDF Export will be added later.');
    }

    public function exportExcel()
    {
        return back()->with('success','Excel Export will be added later.');
    }
}