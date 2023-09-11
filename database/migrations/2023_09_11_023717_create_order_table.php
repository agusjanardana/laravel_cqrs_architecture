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
        Schema::connection('command')->create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id");
            $table->string("username");
            $table->integer("quantity");
            $table->integer("total_price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('command')->dropIfExists('orders');
    }
};