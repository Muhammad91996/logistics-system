@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <h2 class="text-xl font-semibold mb-4">Create Shipment</h2>
    <form method="POST" action="{{ route('shipments.store') }}">
        @csrf
        <input type="text" name="tracking_number" placeholder="Tracking Number" class="w-full border p-2 mb-2" required>
        <input type="text" name="sender_name" placeholder="Sender Name" class="w-full border p-2 mb-2" required>
        <input type="text" name="receiver_name" placeholder="Receiver Name" class="w-full border p-2 mb-2" required>
        <input type="text" name="origin" placeholder="Origin" class="w-full border p-2 mb-2" required>
        <input type="text" name="destination" placeholder="Destination" class="w-full border p-2 mb-2" required>
        <select name="Courier_id" class="w-full border p-2 mb-3">
            <option value="">-- Select Courier --</option>
            @foreach(\App\Models\Courier::all() as $Courier)
                <option value="{{ $Courier->id }}">{{ $Courier->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Create</button>
        
    </form>
</div>
@endsection
