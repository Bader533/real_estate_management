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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->date('from');
            $table->date('to');
            $table->string('number_of_batches');
            $table->string('total_amount_of_rent');
            $table->string('guarantee_amount');
            $table->integer('payment_method');
            $table->foreignId('property_owner_id')->constrained();
            $table->foreignId('apartment_id')->constrained();
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
        Schema::dropIfExists('contracts');
    }
};
