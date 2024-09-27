<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    // Polja koja se mogu masovno dodeliti
    protected $fillable = [
        'user_id',
        'parking_spot_id',
        'vehicle_id',
        'reserved_from',
        'reserved_until',
        'total_price', // Ako dodaješ ovo polje za ukupnu cenu
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function parkingSpot()
{
    return $this->belongsTo(ParkingSpot::class);
}

public function vehicle()
{
    return $this->belongsTo(Vehicle::class);
}

}
