<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    protected $fillable = [
        'donor_id',
        'donation_date',
        'quantity_ml',
        'status',
        'notes',
    ];

    protected $casts = [
        'donation_date' => 'datetime',
        'quantity_ml' => 'integer',
    ];

    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }
}
