<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_cat', // Kategorija vozila
        'user_id',     // ID korisnika koji je kreirao kategoriju
        'creation_date', // Datum kreiranja
    ];

    // Definisanje veze sa korisnikom
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
