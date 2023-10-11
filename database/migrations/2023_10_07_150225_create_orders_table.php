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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //user
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->unsignedBigInteger('user_id');
            //product
            $table->string('product_title');
            $table->integer('quantity');
            $table->float('price');
            $table->string('image');
            $table->unsignedBigInteger('product_id');

            $table->string('payment_status')->nullable();
            $table->string('delivery_status')->nullable();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
