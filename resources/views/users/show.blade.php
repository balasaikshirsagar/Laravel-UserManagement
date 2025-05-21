<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark font-weight-bold">User Details</h2>
    </x-slot>

    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Back to Users
        </a>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ ucfirst($user->gender) }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ $user->role->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Hobbies</th>
                    <td>
                        @forelse($user->hobbies as $hobby)
                            <span class="badge bg-primary">{{ $hobby->name }}</span>
                        @empty
                            <span class="text-muted">No hobbies selected</span>
                        @endforelse
                    </td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Last Updated</th>
                    <td>{{ $user->updated_at->format('M d, Y H:i') }}</td>
                </tr>
            </tbody>
        </table>

        <h5 class="mt-5 mb-3">Change Password</h5>
        <form id="change-password-form" action="{{ route('users.change-password', $user->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div id="password-error" class="text-danger small d-none"></div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                <div id="password_confirmation-error" class="text-danger small d-none"></div>
            </div>

            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>

        <div class="mt-4">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info text-white">
                <i class="fas fa-edit"></i> Edit User
            </a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Delete User
                </button>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('change-password-form').addEventListener('submit', function (e) {
            let isValid = true;
            document.getElementById('password-error').classList.add('d-none');
            document.getElementById('password_confirmation-error').classList.add('d-none');

            let password = document.getElementById('password').value;
            let confirm = document.getElementById('password_confirmation').value;

            if (password === '') {
                document.getElementById('password-error').textContent = 'The password field is required.';
                document.getElementById('password-error').classList.remove('d-none');
                isValid = false;
            } else if (password.length < 8) {
                document.getElementById('password-error').textContent = 'The password must be at least 8 characters.';
                document.getElementById('password-error').classList.remove('d-none');
                isValid = false;
            }

            if (password !== confirm) {
                document.getElementById('password_confirmation-error').textContent = 'The password confirmation does not match.';
                document.getElementById('password_confirmation-error').classList.remove('d-none');
                isValid = false;
            }

            if (!isValid) e.preventDefault();
        });
    </script>
    @endpush
</x-app-layout>
