<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'tracking_number',
        'sender_name',
        'receiver_name',
        'origin',
        'destination',
        'courier_id',
        'status' // ✅ this is required if you're updating it
    ];
    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }
}

