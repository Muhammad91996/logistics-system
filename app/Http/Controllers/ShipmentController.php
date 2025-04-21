<?php

namespace App\Http\Controllers;
use App\Models\Shipment;

use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Shipment::query();
    
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
        return view('shipments.create');
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
        ]);
    
        Shipment::create($validated);
    
        return redirect()->route('shipments.index')->with('success', 'Shipment created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $shipment = Shipment::findOrFail($id);
        return view('shipments.edit', compact('shipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $shipment = Shipment::findOrFail($id);
    
        $validated = $request->validate([
            'tracking_number' => 'required|unique:shipments,tracking_number,' . $shipment->id,
            'sender_name' => 'required',
            'receiver_name' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'status' => 'required|in:pending,in-transit,delivered',
        ]);
    
        $shipment->update($validated);
    
        return redirect()->route('shipments.index')->with('success', 'Shipment updated!');
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
