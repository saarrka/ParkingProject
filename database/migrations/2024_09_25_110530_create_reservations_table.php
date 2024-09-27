<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Referenca na korisnika
            $table->foreignId('parking_spot_id')->constrained()->onDelete('cascade'); // Referenca na parking mesto
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade'); // Referenca na vozilo
            $table->timestamp('reserved_from'); // Kada rezervacija počinje
            $table->timestamp('reserved_until'); // Kada rezervacija završava
            $table->decimal('total_price', 10, 2); // Ukupna cena rezervacije
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
