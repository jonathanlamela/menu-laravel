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
            $table->unsignedInteger('user_id');
            $table->decimal('subtotal');
            $table->decimal('shipping_costs');
            $table->boolean('is_shipping');
            $table->string('shipping_address')->nullable();
            $table->string('shipping_datetime')->nullable();
            $table->unsignedInteger('order_status_id');
            $table->boolean('is_paid');
            $table->text('note')->nullable();
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
