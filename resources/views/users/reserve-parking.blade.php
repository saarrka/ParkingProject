<x-app-layout>
    
    <div class="container mt-5">
        <h1 class="text-center mb-4" style='font-size: 24px; font-weight: bold;'>Reserve Parking Spot</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if($availableSpots->isEmpty())
            <div class="alert alert-warning text-center">
                No available parking spots.
            </div>
        @else
            <div class="text-center mb-4">
                <p class="spot-p">Currently available parking spots: <span>{{ $availableSpots->count() }}</span></p>
                <p class="spot-p">Spot price for 1 hour: <span>{{ $availableSpots->isNotEmpty() ? $availableSpots->first()->price_per_hour . "$" : 'N/A' }} </span></p>
            </div>

            <form action="{{ route('users.reserve-parking.store') }}" class="reserve-spot-form" method="POST">
                @csrf

                <div class="form-group">
                    <label for="parking_spots">Select Parking Spot(s):</label>
                    <select name="parking_spots[]" id="parking_spots" multiple class="form-control" required>
                        @foreach($availableSpots as $spot)
                            <option value="{{ $spot->id }}">Spot {{ $spot->spot_number }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="registration_number">Select Your Vehicle</label>
                    <select name="registration_number" id="registration_number" class="form-control" required>
                        
                        @foreach($userVehicles as $vehicle)
                            <option value="{{ $vehicle->registration_number }}">
                                {{ $vehicle->registration_number }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="reserved_from">Reservation Start Time:</label>
                    <input type="datetime-local" name="reserved_from" id="reserved_from" class="form-control" required placeholder="Select date and time">
                </div>

                <div class="form-group mt-3">
                    <label for="reserved_until">Reservation End Time:</label>
                    <input type="datetime-local" name="reserved_until" id="reserved_until" class="form-control" required placeholder="Select date and time">
                </div>

                <div class="form-group mt-3">
                    <label for="total_price">Total Price ($):</label>
                    <input type="text" name="total_price" id="total_price" class="form-control" readonly>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Reserve</button>
                </div>
            </form>
        @endif
    </div>
    <script src="{{ asset('js/app.js') }}"></script>

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
