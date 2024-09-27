<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//use Bouncer;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // NE ponavljamo ID, email, password
            // Brisemo user_regdate jer Bouncer dodaje kolonu created_at
            $table->string('user_name', 120)->nullable();
            $table->bigInteger('mobile_number')->nullable();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Uklanjanje kolona ako se migracija vrati nazad
            $table->dropColumn(['user_name', 'mobile_number', 
                'email', 'password']);
        });
    }
}
