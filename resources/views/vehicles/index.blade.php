<x-app-layout>

    <div class="container your-vehicles">
        <h1>Add Vehicle</h1>
    
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <form action="{{ route('vehicles.store') }}" method="POST">
            @csrf
            <div class="form-group create-vehicle">
                <label for="category_id">Vehicle category:</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->vehicle_cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group create-vehicle">
                <label for="company">Company Name:</label>
                <input type="text" name="company" id="company" class="form-control" required>
            </div>
            <div class="form-group create-vehicle">
                <label for="registration_number">Registration Number:</label>
                <input type="text" name="registration_number" id="registration_number" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary add-button">Add vehicle</button>
        </form>
    
        <h2 style="margin-top: 80px;">Your Vehicles</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Registration Number</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->company }}</td>
                        <td>{{ $vehicle->registration_number }}</td>
                        <td>{{ $vehicle->category->vehicle_cat }}</td>
                        <td>
                            <!-- Forma za brisanje sa JavaScript potvrdom -->
                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete('{{ $vehicle->registration_number }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    
    <!-- JavaScript za prikazivanje prozora potvrde -->
    <script>
        function confirmDelete(vehicleName) {
            return confirm('Are you sure you want to delete the vehicle with registration number: ' + vehicleName + '?');
        }
    </script>
    
</x-app-layout>
    


