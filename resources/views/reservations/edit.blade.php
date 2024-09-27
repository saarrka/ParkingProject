<x-app-layout>
    <div class="container manage-reservations">
    <h1>Edit Reservation</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group edit-reservation">
            <label for="parking_spot">Select Parking Spot:</label>
            <select name="parking_spot_id" id="parking_spot_id" class="form-control">
                @foreach ($availableSpots as $spot)
                    <option value="{{ $spot->id }}" {{ $reservation->parking_spot_id == $spot->id ? 'selected' : '' }}>
                        Spot {{ $spot->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group edit-reservation">
            <label for="vehicle">Select Vehicle:</label>
            <select name="vehicle_id" id="vehicle_id" class="form-control">
                @foreach ($userVehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ $reservation->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                        {{ $vehicle->registration_number }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="form-group edit-reservation">
            <label for="reserved_from">Reservation Start Time:</label>
            <input type="datetime-local" name="reserved_from" id="reserved_from" class="form-control" required placeholder="Select date and time"
                   value="{{ old('reserved_from', $reservation->reserved_from ? \Carbon\Carbon::parse($reservation->reserved_from)->format('Y-m-d\TH:i') : '') }}">
        </div>
        
        <div class="form-group edit-reservation">
            <label for="reserved_until">Reservation End Time:</label>
            <input type="datetime-local" name="reserved_until" id="reserved_until" class="form-control" required placeholder="Select date and time"
                   value="{{ old('reserved_until', $reservation->reserved_until ? \Carbon\Carbon::parse($reservation->reserved_until)->format('Y-m-d\TH:i') : '') }}">
        </div>
        
        <div class="form-group edit-reservation">
            <label for="total_price">Total Price ($):</label>
            <input type="text" name="total_price" id="total_price" class="form-control" readonly
                   value="{{ old('total_price', $reservation->total_price) }}">
        </div>
        

        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('reserved_until').addEventListener('change', calculatePrice);
            document.getElementById('reserved_from').addEventListener('change', calculatePrice);

            function calculatePrice() {
                const reservedFrom = new Date(document.getElementById('reserved_from').value);
                const reservedUntil = new Date(document.getElementById('reserved_until').value);

                if (reservedFrom && reservedUntil && reservedFrom < reservedUntil) {
                    const differenceInMillis = reservedUntil - reservedFrom; // Razlika u milisekundama
                    const differenceInHours = differenceInMillis / (1000 * 60 * 60); // Razlika u satima

                    // Cena po satu
                    const pricePerHour = 1;
                    // Ukupna cena
                    const totalPrice = Math.ceil(differenceInHours) * pricePerHour;

                    // Postavi izračunatu cenu sa zaokruživanjem na 2 decimale
                    document.getElementById('total_price').value = totalPrice.toFixed(2);
                } else {
                    document.getElementById('total_price').value = '0.00'; // Resetuj cenu ako su podaci nevalidni
                }
            }
        });
    </script>
</x-app-layout>
