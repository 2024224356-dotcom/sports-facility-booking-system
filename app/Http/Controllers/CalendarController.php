<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display Calendar
     */
    public function index()
    {
        return view('calendar.index');
    }

    /**
     * Return Calendar Events (JSON)
     */
    public function events()
    {
        $bookings = Booking::with(['facility', 'user'])->get();

        $events = [];

        foreach ($bookings as $booking) {

            switch ($booking->booking_status) {

                case 'approved':
                    $color = '#10B981';
                    break;

                case 'pending':
                    $color = '#F59E0B';
                    break;

                case 'completed':
                    $color = '#3B82F6';
                    break;

                case 'rejected':
                    $color = '#EF4444';
                    break;

                default:
                    $color = '#6B7280';
                    break;
            }

            $events[] = [

                'id' => $booking->id,

                'title' =>
                    $booking->facility->facility_name .
                    ' - ' .
                    $booking->user->name,

                'start' =>
                    $booking->booking_date .
                    'T' .
                    $booking->start_time,

                'end' =>
                    $booking->booking_date .
                    'T' .
                    $booking->end_time,

                'backgroundColor' => $color,

                'borderColor' => $color,

                'textColor' => '#ffffff',

                'extendedProps' => [

                    'student' => $booking->user->name,

                    'facility' => $booking->facility->facility_name,

                    'status' => ucfirst($booking->booking_status),

                    'purpose' => $booking->purpose,

                    'remarks' => $booking->remarks,

                ],

            ];
        }

        return response()->json($events);
    }
}