@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <h2 class="text-2xl font-semibold mb-4">All Shipments</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('shipments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">+ New Shipment</a>

    <table class="w-full text-left border-collapse mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Tracking #</th>
                <th class="p-2 border">Sender</th>
                <th class="p-2 border">Receiver</th>
                <th class="p-2 border">Origin</th>
                <th class="p-2 border">Destination</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shipments as $shipment)
                <tr>
                    <td class="p-2 border">{{ $shipment->tracking_number }}</td>
                    <td class="p-2 border">{{ $shipment->sender_name }}</td>
                    <td class="p-2 border">{{ $shipment->receiver_name }}</td>
                    <td class="p-2 border">{{ $shipment->origin }}</td>
                    <td class="p-2 border">{{ $shipment->destination }}</td>
                    <td class="p-2 border">{{ ucfirst($shipment->status) }}</td>
                    <td class="p-2 border"><a href="{{ route('shipments.edit', $shipment->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                    <form action="{{ route('shipments.destroy', $shipment->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">@csrf @method('DELETE') <button type="submit" class="text-red-600 hover:underline">Delete</button></form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $shipments->links() }}
    </div>
</div>
@endsection