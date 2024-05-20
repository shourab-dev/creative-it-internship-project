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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('payment_option')->default('cod');
            $table->string('transaction_id')->nullable();
            $table->string('payment_phone')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('shipping')->default('home');
            $table->string('point')->nullable();
            $table->string('phone');
            $table->string('note')->nullable();
            $table->float('total_price');
            $table->integer('total_qty')->default(1);
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
        Schema::dropIfExists('orders');
    }
};
