<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParkingSpot extends Model
{
    use HasFactory;

    // Ako ime tabele nije 'parking_spots', definišite ime tabele ručno
    protected $table = 'parking_spots';

    // Definišite koji atributi mogu biti masovno popunjeni
    protected $fillable = [
        'spot_number',
        'is_occupied',
        'user_id',
        'reserved_from',
        'reserved_until'
    ];

    // Relacija sa User modelom, jer parking mesto može pripadati korisniku
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
{
    return $this->hasMany(Reservation::class);
}

}
