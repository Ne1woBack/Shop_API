<?php

use App\Models\Product;
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
            $table->foreignIdFor(Product::class);
            $table->string('color')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('qnt');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('total-price');
            $table->boolean('flag')->default(1);
            $table->string('address');
            $table->string('tel_number');
            $table->longText('discription')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
