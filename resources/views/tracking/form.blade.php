@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-12">
    <h2 class="text-xl font-semibold mb-6">Track Your Shipment</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            {{ $errors->first('tracking_number') }}
        </div>
    @endif

    <form method="POST" action="{{ route('tracking.search') }}">
        @csrf
        <input type="text" name="tracking_number" placeholder="Enter Tracking Number" class="w-full border p-2 mb-4" required>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Track</button>
    </form>
</div>
@endsection
