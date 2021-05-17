<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentPixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_pix', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_payment_id');
            $table->decimal('total_paid_amount', 10, 2);
            $table->text('qr_code');
            $table->text('qr_code_base64');
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
        Schema::dropIfExists('payment_pix');
    }
}
