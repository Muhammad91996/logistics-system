@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10">
    <h2 class="text-2xl font-semibold mb-6">Track a Shipment</h2>

    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('tracking.search') }}">
        @csrf
        <input type="text" name="tracking_number" placeholder="Enter Tracking Number"
            class="w-full border p-2 mb-4" required>

        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Track Shipment
        </button>
    </form>
</div>
@endsection
