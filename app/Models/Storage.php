<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'notes'];

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }

    //  limite de 50 em cada dep
    public function getOccupationPercentAttribute()
    {
        $count = $this->inventory()->count();
        return ($count / 50) * 100;
    }
}

