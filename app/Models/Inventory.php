<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['chemical_product_id', 'storage_id', 'quantity', 'unit', 'lot_number', 'expiration_date'];

    public function product()
    {
        return $this->belongsTo(ChemicalProduct::class, 'chemical_product_id');
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }
}
