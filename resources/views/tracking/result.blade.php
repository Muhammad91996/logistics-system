@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-4">Shipment Details</h2>

    <div class="bg-white shadow p-4 rounded space-y-3">
        <p><strong>Tracking Number:</strong> {{ $shipment->tracking_number }}</p>
        <p><strong>Status:</strong> {{ ucfirst($shipment->status) }}</p>
        <p><strong>Sender:</strong> {{ $shipment->sender_name }}</p>
        <p><strong>Receiver:</strong> {{ $shipment->receiver_name }}</p>
        <p><strong>Origin:</strong> {{ $shipment->origin }}</p>
        <p><strong>Destination:</strong> {{ $shipment->destination }}</p>
        @if($shipment->courier)
            <p><strong>Courier:</strong> {{ $shipment->courier->name }}</p>
        @endif
    </div>

    <a href="{{ route('tracking.form') }}" class="inline-block mt-6 text-blue-600 hover:underline">Track another shipment</a>
</div>
@endsection
