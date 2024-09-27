<x-app-layout>

    <div class="container your-vehicles">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
    
        <h2 style="margin-top: 80px;">All Vehicles</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Owner</th>
                    <th>Company</th>
                    <th>Registration Number</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->user->user_name }}</td>
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
    


