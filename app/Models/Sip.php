<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'frequency',
        'sip_day',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // 🔁 Relationship: SIP belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔁 Relationship: SIP has many Invoices
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}