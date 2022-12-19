<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('kind');
            $table->string('apartment_name');
            $table->date('apartment_date_added')->nullable();
            $table->string('city');
            $table->string('address');
            $table->string('space');
            $table->string('ac_type')->nullable();
            $table->string('floor_number')->nullable();
            $table->string('number_of_bedrooms')->nullable();
            $table->string('number_of_bathrooms')->nullable();
            $table->string('number_of_councils')->nullable();
            $table->string('number_of_lounges')->nullable();
            $table->string('furnishing_condition')->nullable();
            $table->string('type_of_kitchen')->nullable();
            $table->string('parking')->nullable();
            $table->string('electricity_meter_number')->nullable();
            $table->string('water_meter_number')->nullable();
            $table->foreignId('building_id')->nullable();
            $table->foreignId('compound_id')->nullable();
            $table->foreignId('property_owner_id')->constrained();
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
        Schema::dropIfExists('apartments');
    }
};
