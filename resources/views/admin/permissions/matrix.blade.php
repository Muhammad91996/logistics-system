@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">Permission Matrix</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.permissions.matrix.update') }}">
        @csrf

        <div class="overflow-x-auto">
            <table class="table-auto border-collapse w-full text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border text-left">Permission \ Role</th>
                        @foreach ($roles as $role)
                            <th class="p-2 border text-center">{{ ucfirst($role->name) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td class="border p-2 font-medium">{{ $permission->name }}</td>
                            @foreach ($roles as $role)
                                <td class="border text-center">
                                    <input type="checkbox"
                                           name="role_permissions[{{ $role->id }}][]"
                                           value="{{ $permission->name }}"
                                           {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
