<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipping_fees', function (Blueprint $table) {
            $table->id();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->string('state');
            $table->decimal('base_fee', 8, 2);
            $table->string('est_delivery_time')->nullable();
            $table->timestamps();
            $table->unique(['country_id', 'state']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_fees');
    }
};
