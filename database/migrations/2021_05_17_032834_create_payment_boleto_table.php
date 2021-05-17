<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentBoletoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_boleto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_payment_id');
            $table->bigInteger('payment_method_reference_id');
            $table->bigInteger('verification_code');
            $table->decimal('total_paid_amount', 10, 2);
            $table->text('external_resource_url');
            $table->foreign('order_payment_id')->references('id')->on('order_payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_boleto');
    }
}
