<x-app-layout>

    <div class="container manage-categories">
        <h1>Edit Vehicle</h1>
    
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group edit-vehicle">
                <label for="category_id">Vehicle Category:</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $vehicle->category_id ? 'selected' : '' }}>
                            {{ $category->vehicle_cat }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group edit-vehicle">
                <label for="company">Company Name:</label>
                <input type="text" name="company" id="company" class="form-control" value="{{ $vehicle->company }}" required>
            </div>
    
            <div class="form-group edit-vehicle">
                <label for="registration_number">Registration Number:</label>
                <input type="text" name="registration_number" id="registration_number" class="form-control" value="{{ $vehicle->registration_number }}" required>
            </div>
    
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Update Vehicle</button>
                <a href="{{ route('admins.view-vehicles') }}" class="btn btn-danger">Back</a> {{-- Dugme za povratak na listu kategorija --}}
            </div>
        </form>
    </div>
    
    </x-app-layout>
    