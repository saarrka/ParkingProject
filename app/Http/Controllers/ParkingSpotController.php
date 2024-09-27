<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vehicle;
use App\Models\ParkingSpot;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ParkingSpotController extends Controller
{
    // Prikaz forme za rezervaciju
    public function create()
    {
        // Pronađi sva slobodna mesta
        $availableSpots = ParkingSpot::where('is_occupied', false)->get();
        $userVehicles = Vehicle::where('user_id', auth()->id())->get();
        
        return view('users.reserve-parking', compact('availableSpots', 'userVehicles'));
    }
 
    // Obrada rezervacije
public function store(Request $request)
{
    // Validacija podataka
    $request->validate([
        'parking_spots' => 'required|array',
        'parking_spots.*' => 'exists:parking_spots,id',
        'registration_number' => 'required|string',
        'reserved_from' => 'required|date|after_or_equal:today',
        'reserved_until' => 'required|date|after:reserved_from',
    ]);

    // Pronađi vozilo na osnovu registration_number
    $vehicle = Vehicle::where('registration_number', $request->registration_number)->first();

    if (!$vehicle) {
        return back()->withErrors(['registration_number' => 'Vehicle not found.']);
    }

    // Izračunaj ukupnu cenu
    $totalPrice = 0;

    // Rezerviši odabrana parking mesta
    foreach ($request->parking_spots as $spotId) {
        $spot = ParkingSpot::findOrFail($spotId);
        
        // Postavi potrebna polja za parking mesto
        $spot->user_id = auth()->id();
        $spot->vehicle_id = $vehicle->id;
        $spot->is_occupied = true;
        $spot->reserved_from = $request->reserved_from;
        $spot->reserved_until = $request->reserved_until;

        // Izračunaj cenu za ovo parking mesto
        $reservedFrom = new Carbon($request->reserved_from);
        $reservedUntil = new Carbon($request->reserved_until);

        // Izračunaj razliku u minutima
        $minutes = $reservedFrom->diffInMinutes($reservedUntil);

        // Izračunaj broj sati, koristeći ceil da se osigura da se svaki započeti sat naplaćuje
        $hours = ceil($minutes / 60);

        // Dodaj cenu za ovo parking mesto
        $totalPrice += $hours * $spot->price_per_hour;

        // Sačuvaj parking mesto
        $spot->save();
    }

    // Sačuvaj rezervaciju u tabeli reservations
    Reservation::create([
        'user_id' => auth()->id(),
        'parking_spot_id' => implode(',', $request->parking_spots), // Čuva sve ID-ove parking mesta kao string
        'vehicle_id' => $vehicle->id,
        'reserved_from' => $request->reserved_from,
        'reserved_until' => $request->reserved_until,
        'total_price' => $totalPrice, // Dodaj ukupnu cenu
    ]);

    return redirect()->route('reservations.index')->with('success', 'Parking spot(s) reserved successfully.');
}




}
