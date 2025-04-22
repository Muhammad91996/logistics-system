@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-8">
    <h2 class="text-xl font-semibold mb-4">Edit Driver</h2>

        <form action="{{ route('admin.couriers.update', $courier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $courier->name }}" class="w-full border p-2 mb-3" required>
        <input type="text" name="phone" value="{{ $courier->phone }}" class="w-full border p-2 mb-3">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
