<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

     // Definiši naziv tabele (opciono, ako ne koristiš konvenciju)
     protected $table = 'vehicles';

     // Definiši koje atribute su masovno dodeljive
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'category_id',
        'company', // Ispravljen naziv polja
        'registration_number',
    ];
 
     // Definiši relaciju sa korisnikom (ako je potrebno)
    public function user()
    {
     return $this->belongsTo(User::class);
    }
 
    // Definiši relaciju sa kategorijom
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function parkingSpot()
    {
        return $this->hasOne(ParkingSpot::class);
    }

    public function reservations()
{
    return $this->hasMany(Reservation::class);
}

}
