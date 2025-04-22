@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-8">
    <h2 class="text-xl font-semibold mb-4">Add New Driver</h2>

    <form action="{{ route('admin.couriers.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Driver Name" class="w-full border p-2 mb-3" required>
        <input type="text" name="phone" placeholder="Phone Number (optional)" class="w-full border p-2 mb-3">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create</button>
    </form>
</div>
@endsection
