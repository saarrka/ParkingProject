<x-app-layout>
    <div class="container view-reservations">
        <h1>Your Reservations</h1>

        @if($reservations->isEmpty())
            <p>No reservations found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Parking Spot Number</th>
                        <th>Vehicle Registration Number</th>
                        <th>Reserved From</th>
                        <th>Reserved Until</th>
                        <th>Price</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->parkingSpot->spot_number }}</td>
                            <td>{{ $reservation->vehicle->registration_number }}</td>
                            <td>{{ $reservation->reserved_from }}</td>
                            <td>{{ $reservation->reserved_until }}</td>
                            <td>{{ $reservation->total_price }}</td>
                            <td>
                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete('{{ $reservation->vehicle->registration_number }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        function confirmDelete(registrationNumber) {
            return confirm('Are you sure you want to delete reservation for vehicle with registration number "' + registrationNumber + '"?');
        }
    </script>
</x-app-layout>
