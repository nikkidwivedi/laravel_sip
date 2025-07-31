<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'sip_id',
        'user_id',
        'amount',
        'scheduled_date',
        'status',
        'debit_response',
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
    ];

    // 🔁 Relationship: Invoice belongs to a SIP
    public function sip()
    {
        return $this->belongsTo(Sip::class);
    }

    // 🔁 Relationship: Invoice belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}