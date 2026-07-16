<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacilityFeature extends Model
{
    use HasFactory;

    protected $fillable = [

        'facility_id',

        'feature_name',

        'description'

    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}