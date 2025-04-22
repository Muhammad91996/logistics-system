@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <h2 class="text-xl font-semibold mb-4">Edit Shipment</h2>

    <form method="POST" action="{{ route('shipments.update', $shipment->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="tracking_number" value="{{ $shipment->tracking_number }}" class="w-full border p-2 mb-2" required>
        <input type="text" name="sender_name" value="{{ $shipment->sender_name }}" class="w-full border p-2 mb-2" required>
        <input type="text" name="receiver_name" value="{{ $shipment->receiver_name }}" class="w-full border p-2 mb-2" required>
        <input type="text" name="origin" value="{{ $shipment->origin }}" class="w-full border p-2 mb-2" required>
        <input type="text" name="destination" value="{{ $shipment->destination }}" class="w-full border p-2 mb-2" required>

        <select name="status" class="w-full border p-2 mb-2" required>
            <option value="pending" {{ $shipment->status === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in-transit" {{ $shipment->status === 'in-transit' ? 'selected' : '' }}>In Transit</option>
            <option value="delivered" {{ $shipment->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
        </select>
        <select name="driver_id" class="w-full border p-2 mb-3">
            <option value="">-- Select Driver --</option>
            @foreach(\App\Models\Courier::all() as $driver)
                <option value="{{ $driver->id }}" {{ $shipment->driver_id == $driver->id ? 'selected' : '' }}>
                    {{ $driver->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Update</button>
    </form>
</div>
@endsection
