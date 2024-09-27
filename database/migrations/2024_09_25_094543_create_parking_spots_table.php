<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_spots', function (Blueprint $table) {
            $table->id();
            $table->integer('spot_number')->unique(); // Broj parking mesta
            $table->boolean('is_occupied')->default(false); // Da li je mesto zauzeto
            $table->decimal('price_per_hour', 8, 2)->default(1.00); // Cena po satu
            $table->foreignId('user_id')->nullable()->constrained(); // Referenca na korisnika koji je rezervisao mesto
            $table->foreignId('vehicle_id')->nullable()->constrained(); // Referenca na vozilo koje je rezervisano za mesto
            $table->timestamp('reserved_from')->nullable(); // Kada je rezervacija pocela
            $table->timestamp('reserved_until')->nullable(); // Kada rezervacija istice
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
        Schema::dropIfExists('parking_spots');
    }
}