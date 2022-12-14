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
            $table->string('apartment_name');
            $table->date('apartment_date_added');
            $table->string('city');
            $table->string('address');
            $table->string('ac_type');
            $table->string('floor_number');
            $table->string('number_of_bedrooms');
            $table->string('number_of_bathrooms');
            $table->string('number_of_councils');
            $table->string('number_of_lounges');
            $table->string('furnishing_condition');
            $table->string('type_of_kitchen');
            $table->string('parking');
            $table->string('electricity_meter_number');
            $table->string('water_meter_number');
            $table->foreignId('building_id')->constrained();
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
