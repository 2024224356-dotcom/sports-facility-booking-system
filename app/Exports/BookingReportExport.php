<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BookingReportExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Booking::with(['user', 'facility']);

        if (!empty($this->filters['facility'])) {
            $query->where('facility_id', $this->filters['facility']);
        }

        if (!empty($this->filters['student'])) {
            $query->where('user_id', $this->filters['student']);
        }

        if (!empty($this->filters['status'])) {
            $query->where('booking_status', $this->filters['status']);
        }

        if (!empty($this->filters['date_from'])) {
            $query->whereDate('booking_date', '>=', $this->filters['date_from']);
        }

        if (!empty($this->filters['date_to'])) {
            $query->whereDate('booking_date', '<=', $this->filters['date_to']);
        }

        return $query->orderBy('booking_date', 'desc')
            ->get()
            ->map(function ($booking) {

                return [

                    $booking->id,

                    $booking->user->name,

                    $booking->user->student_id,

                    $booking->user->email,

                    $booking->facility->facility_name,

                    $booking->booking_date,

                    $booking->start_time,

                    $booking->end_time,

                    ucfirst($booking->booking_status),

                    $booking->purpose,

                    $booking->remarks,

                    $booking->created_at->format('d/m/Y H:i'),

                ];

            });
    }

    public function headings(): array
    {
        return [

            'Booking ID',

            'Student Name',

            'Student ID',

            'Email',

            'Facility',

            'Booking Date',

            'Start Time',

            'End Time',

            'Status',

            'Purpose',

            'Remarks',

            'Created At',

        ];
    }
}