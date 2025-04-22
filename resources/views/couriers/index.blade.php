@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-semibold mb-6">All couriers</h2>

    <a href="{{ route('admin.couriers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
        + New courier
    </a>


    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse text-left">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Name</th>
                <th class="border p-2">Phone</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($couriers as $courier)
                <tr>
                    <td class="border p-2">{{ $courier->name }}</td>
                    <td class="border p-2">{{ $courier->phone ?? '-' }}</td>
                    <td class="border p-2">
                        <a href="{{ route('admin.couriers.edit', $courier->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('admin.couriers.destroy', $courier->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">No couriers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
