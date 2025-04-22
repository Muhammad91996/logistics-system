<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Courier;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Shipment::with('Courier'); // eager load Courier

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $shipments = $query->latest()->paginate(10);

        return view('shipments.index', compact('shipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Couriers = Courier::all();
        return view('shipments.create', compact('Couriers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tracking_number' => 'required|unique:shipments',
            'sender_name' => 'required',
            'receiver_name' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'courier_id' => 'required|exists:couriers,id',
        ]);
    
        Shipment::create($validated);
    
        return redirect()->route('shipments.index')->with('success', 'Shipment created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        $couriers = Courier::all();
        return view('shipments.edit', compact('shipment', 'couriers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipment)
{
    $request->validate([
        'tracking_number' => 'required|string|max:255',
        'sender_name' => 'required|string|max:255',
        'receiver_name' => 'required|string|max:255',
        'origin' => 'required|string|max:255',
        'destination' => 'required|string|max:255',
        'status' => 'required|in:pending,in-transit,delivered',
        'courier_id' => 'nullable|exists:couriers,id',
    ]);

    $shipment->update($request->all());

    return redirect()->route('shipments.index')->with('success', 'Shipment updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $shipment = Shipment::findOrFail($id);
        $shipment->delete();

        return redirect()->route('shipments.index')->with('success', 'Shipment deleted!');
    }
}
