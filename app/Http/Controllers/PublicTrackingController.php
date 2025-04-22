<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class PublicTrackingController extends Controller
{
    public function showForm()
    {
        return view('tracking.form');
    }

    public function track(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string',
        ]);

        $shipment = Shipment::with('courier')->where('tracking_number', $request->tracking_number)->first();

        if (!$shipment) {
            return redirect()->route('tracking.form')->withErrors(['tracking_number' => 'Tracking number not found.']);
        }

        return view('tracking.result', compact('shipment'));
    }
}
