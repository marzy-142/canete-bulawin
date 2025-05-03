<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BloodInventory extends Model
{
    protected $fillable = [
        'blood_type',
        'quantity_ml',
        'expiry_date',
        'status',
        'donation_id',
    ];

    protected $casts = [
        'expiry_date' => 'datetime',
        'quantity_ml' => 'integer',
    ];

    public function donation(): BelongsTo
    {
        return $this->belongsTo(Donation::class);
    }
}
