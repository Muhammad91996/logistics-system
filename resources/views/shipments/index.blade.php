@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-semibold mb-4">All Shipments</h2>

    {{-- Filter by Status --}}
    <form method="GET" action="{{ route('shipments.index') }}" class="mb-6 flex items-center gap-4">
        <label for="status" class="text-sm font-medium text-gray-700">Filter by Status:</label>
        <select name="status" id="status" onchange="this.form.submit()" class="border p-2 rounded">
            <option value="">All</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in-transit" {{ request('status') == 'in-transit' ? 'selected' : '' }}>In Transit</option>
            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
        </select>
    </form>

    {{-- New Shipment Button (optional: wrap in admin check) --}}
    @if(auth()->user()->isAdmin())
        <a href="{{ route('shipments.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">
            + New Shipment
        </a>
    @endif

    {{-- Success Message --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Shipments Table --}}
    <table class="w-full text-left border-collapse mt-4">
        <thead>
            <tr class="bg-gray-100 text-sm">
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
            @forelse ($shipments as $shipment)
                <tr>
                    <td class="p-2 border">{{ $shipment->tracking_number }}</td>
                    <td class="p-2 border">{{ $shipment->sender_name }}</td>
                    <td class="p-2 border">{{ $shipment->receiver_name }}</td>
                    <td class="p-2 border">{{ $shipment->origin }}</td>
                    <td class="p-2 border">{{ $shipment->destination }}</td>
                    <td class="p-2 border">
                        @php
                            $color = match($shipment->status) {
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'in-transit' => 'bg-blue-100 text-blue-800',
                                'delivered' => 'bg-green-100 text-green-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp
                        <span class="px-2 py-1 rounded text-xs font-semibold {{ $color }}">
                            {{ ucfirst($shipment->status) }}
                        </span>
                    </td>
                    <td class="p-2 border">
                        <a href="{{ route('shipments.edit', $shipment->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('shipments.destroy', $shipment->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">No shipments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $shipments->appends(request()->query())->links() }}
    </div>
</div>
@endsection
