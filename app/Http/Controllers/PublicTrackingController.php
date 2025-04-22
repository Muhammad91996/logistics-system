<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;

class PublicTrackingController extends Controller
{
    public function showForm()
{
    return view('tracking.form');
}

public function track(Request $request)
{
    $trackingNumber = $request->input('tracking_number');

    $shipment = Shipment::with('courier')
        ->where('tracking_number', $trackingNumber)
        ->first();

    if (!$shipment) {
        return redirect()->route('tracking.form')->with('error', 'Shipment not found.');
    }

    return view('tracking.result', compact('shipment'));
}

}
