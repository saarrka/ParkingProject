<x-app-layout>
    <div class="container mt-5">
        <x-all-users>
            {{-- Forma za dodavanje novog korisnika --}}
            <h1>Create New User</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST" class="create-users">
                @csrf
                <div class="form-group create-user">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group create-user">
                    <label for="user_name">Username</label>
                    <input type="text" name="user_name" class="form-control" required>
                </div>
                <div class="form-group create-user">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" name="mobile_number" class="form-control" required>
                </div>
                <div class="form-group create-user">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group create-user">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group create-user">
                    <label for="role">Role</label>
                    <select name="role" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Create User</button>
            </form>
        </x-all-users>
    </div>
</x-app-layout>

