<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'cas_number', 'justification', 'user_id', 'status',
        'controlled_by', 'product_type', 'fds_revision_date', 'pictograms', 'safety_precautions'
    ];

    // multiseleção 
    protected $casts = [
        'pictograms' => 'array',
    ];

    //Quem solicitou
    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Quem avaliou
    public function evaluator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    // tradutor
    public function getStatusFormatadoAttribute()
    {
        $statusMap = [
            'pending'  => 'Pendente',
            'approved' => 'Aprovado',
            'rejected' => 'Reprovado',
        ];

        return $statusMap[$this->status] ?? $this->status;
    }
}