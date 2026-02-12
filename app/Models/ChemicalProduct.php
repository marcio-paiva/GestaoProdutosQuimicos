<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChemicalProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cas_number',
        'formula',
        'description',
        'risk_level',
        'is_approved',
        'fds_revision_date', 
        'pictograms', 
        'safety_precautions'
    ];

    protected $casts = [
        'pictograms' => 'array',
        'fds_revision_date' => 'date', 
    ];
}