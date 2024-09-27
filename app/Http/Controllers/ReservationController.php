<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vehicle;
use App\Models\ParkingSpot;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        // Dobij sve rezervacije korisnika
        $reservations = Reservation::with(['user', 'parkingSpot', 'vehicle'])
            ->where('user_id', Auth::id())
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function edit($id) {
        $reservation = Reservation::findOrFail($id);
        $userVehicles = Vehicle::where('user_id', auth()->id())->get();

        // Pronadji sva slobodna parking mesta
        $availableSpots = ParkingSpot::where('is_occupied', false)
            ->orWhere('id', $reservation->parking_spot_id) // Dodaj trenutno rezervisano mesto
            ->get();
        
        
        return view('reservations.edit', compact('reservation', 'userVehicles', 'availableSpots'));       
    }

    public function update(Request $request, $id)
{
    // Validacija ulaznih podataka
    $request->validate([
        'parking_spot_id' => 'nullable|exists:parking_spots,id',
        'vehicle_id' => 'nullable|exists:vehicles,id',
        'reserved_from' => 'nullable|date|after_or_equal:today',
        'reserved_until' => 'nullable|date|after:reserved_from',
    ]);

    // Pronađi rezervaciju po ID-u
    $reservation = Reservation::findOrFail($id);

    // Ažuriraj vehicle_id ako je prosleđen
    if ($request->vehicle_id) {
        $reservation->vehicle_id = $request->vehicle_id; // Ažuriraj vehicle_id
    }

    // Oslobodi staro parking mesto
    $oldSpotId = $reservation->parking_spot_id;
    ParkingSpot::where('id', $oldSpotId)->update([
        'is_occupied' => false,
        'user_id' => null,  // Postavi user_id na null
        'vehicle_id' => null // Postavi vehicle_id na null
    ]);

    // Ažuriraj parking_spot_id ako je prosleđen
    if ($request->parking_spot_id) {
        $reservation->parking_spot_id = $request->parking_spot_id; // Ažuriraj parking_spot_id
        // Zauzmi novo parking mesto
        ParkingSpot::where('id', $request->parking_spot_id)->update([
            'is_occupied' => true,
            'user_id' => auth()->id(), // ili ID korisnika koji je napravio rezervaciju
            'vehicle_id' => $reservation->vehicle_id // Ažuriraj vehicle_id na novo parking mesto
        ]);
    }

    // Ažuriraj vreme rezervacije
    if ($request->reserved_from) {
        $reservation->reserved_from = new Carbon($request->reserved_from);
    }
    if ($request->reserved_until) {
        $reservation->reserved_until = new Carbon($request->reserved_until);
    }

    // Izračunaj ukupnu cenu
    $minutes = $reservation->reserved_from->diffInMinutes($reservation->reserved_until);
    $hours = ceil($minutes / 60); // Zaokruži na sat
    $totalPrice = $hours * ParkingSpot::findOrFail($reservation->parking_spot_id)->price_per_hour;

    $reservation->total_price = $totalPrice; // Ažuriraj ukupnu cenu
    $reservation->save(); // Sačuvaj rezervaciju

    return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
}


    public function destroy($id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

         // Oslobodi parking mesto pre brisanja rezervacije
        ParkingSpot::where('id', $reservation->parking_spot_id)->update([
            'is_occupied' => false,
            'user_id' => null,  // Postavi user_id na null
            'vehicle_id' => null // Postavi vehicle_id na null
        ]);
        
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }


}
