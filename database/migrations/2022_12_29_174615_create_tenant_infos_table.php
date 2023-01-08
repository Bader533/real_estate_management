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
        Schema::create('tenant_infos', function (Blueprint $table) {
            $table->id();
            $table->string('payment');
            $table->string('apartment_clean');
            $table->string('apartment_interest');
            $table->string('annoyance');
            $table->string('description', 1000);
            $table->foreignId('tenant_id')->constrained();
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
        Schema::dropIfExists('tenant_infos');
    }
};
