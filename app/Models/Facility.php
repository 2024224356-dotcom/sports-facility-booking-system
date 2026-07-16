<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_type_id',
        'facility_name',
        'availability_status',
    ];

    public function facilityType()
    {
        return $this->belongsTo(FacilityType::class);
    }
}