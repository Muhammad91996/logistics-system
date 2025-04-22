@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <h2 class="text-2xl font-semibold mb-4">Role Management</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add New Role -->
    <div class="mb-8">
        <form action="{{ route('admin.roles.store') }}" method="POST" class="flex items-center space-x-4">
            @csrf
            <input type="text" name="name" placeholder="New Role Name" required
                class="border rounded p-2 w-64">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add Role</button>
        </form>
    </div>

    <!-- Roles and Permissions Table -->
    <table class="w-full table-auto border-collapse">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="p-2 border">Role</th>
                <th class="p-2 border">Permissions</th>
                <th class="p-2 border">Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr class="border-b">
                    <td class="p-2 border font-medium">{{ ucfirst($role->name) }}</td>
                    <td class="p-2 border">
                        <form action="{{ route('admin.roles.assignPermissions', $role->id) }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                                @foreach ($permissions as $permission)
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="permissions[]"
                                            value="{{ $permission->name }}"
                                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                        <span>{{ $permission->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                    </td>
                    <td class="p-2 border">
                            <button type="submit"
                                class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">
                                Save
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
