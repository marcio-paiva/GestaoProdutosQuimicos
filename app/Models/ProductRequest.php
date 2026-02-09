<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_name',
        'cas_number',
        'justification',
        'status',
        'evaluator_feedback',
        'evaluator_id'
    ];

    // Relacionamento: Quem solicitou
    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relacionamento: Quem avaliou
    public function evaluator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}