<x-app-layout>
    <div class="container mt-5 edit-profile">
        <h1>Edit Profile</h1>

        {{-- Prikaz uspešne poruke --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}"  method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="form-group edit-user-profile">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <!-- User Name -->
            <div class="form-group edit-user-profile">
                <label for="user_name">User Name</label>
                <input type="text" name="user_name" class="form-control" value="{{ old('user_name', $user->user_name) }}" required>
            </div>
        
            <!-- Mobile Number -->
            <div class="form-group edit-user-profile">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $user->mobile_number) }}">
            </div>
        
            <!-- Password (Existing Password) -->
            <div class="form-group edit-user-profile">
                <label for="password">Current Password (required for confirmation)</label>
                <input type="password" name="password" class="form-control" required>
            </div>
        
            <!-- New Password -->
            <div class="form-group edit-user-profile">
                <label for="new_password">New Password (optional)</label>
                <input type="password" name="new_password" class="form-control">
            </div>
        
            <!-- Confirm New Password -->
            <div class="form-group edit-user-profile">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="form-control">
            </div>
        
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</x-app-layout>
