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
        Schema::connection('query')->create('order_histories', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id");
            $table->integer("order_id");
            $table->string("username");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('query')->dropIfExists('order_histories');
    }
};
