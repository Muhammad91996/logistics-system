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
        'status',
        'courier_id',
    ];
    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }
}

