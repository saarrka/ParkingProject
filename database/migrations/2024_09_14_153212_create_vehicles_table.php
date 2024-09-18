<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primarni ključ
            $table->unsignedBigInteger('user_id'); // Strani ključ za vezu 1:N
            $table->string('parking_number', 120)->nullable(); // Broj parking mesta
            $table->string('vehicle_category', 120); // Kategorija vozila
            $table->string('vehicle_company_name', 120)->nullable(); // Naziv kompanije vozila
            $table->string('registration_number', 120)->nullable(); // Registracijski broj
            $table->string('owner_name', 120)->nullable(); // Ime vlasnika
            $table->bigInteger('owner_contact_number')->nullable(); // Kontakt broj vlasnika
            $table->timestamp('in_time')->default(now()); // Vreme ulaska
            $table->timestamp('out_time')->nullable(); // Vreme izlaska (bez onUpdate sada)
            $table->string('parking_charge', 120); // Naknada za parking
            $table->mediumText('remark'); // Napomena
            $table->string('status', 5); // Status vozila

            // Definisanje stranog ključa
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }

}
