<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Management') }}
            </h2>
            <div>
                <a href="{{ route('users.create') }}" class="btn btn-primary mr-2">
                    <i class="fas fa-plus"></i> Add User
                </a>
                <a href="{{ route('users.export-excel') }}" class="btn btn-success mr-2">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
                <a href="{{ route('users.export-pdf') }}" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead class="bg-gray-50">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Role</th>
                                <th>Hobbies</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->role->name ?? 'N/A' }}</td>
                                    <td>
                                        @foreach($user->hobbies as $hobby)
                                            <span class="badge bg-primary text-white">{{ $hobby->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
    <div class="d-flex flex-row align-items-center">
        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info text-white mr-2">
            <i class="fas fa-eye mr-1"></i> View
        </a>
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning text-white mr-2">
            <i class="fas fa-edit mr-1"></i> Edit
        </a>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash mr-1"></i> Delete
            </button>
        </form>
    </div>
</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
