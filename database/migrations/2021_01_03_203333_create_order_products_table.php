<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('placa_id')->nullable();
            $table->unsignedBigInteger('modelo_id')->nullable();
            $table->unsignedBigInteger('moldura_id')->nullable();
            $table->unsignedBigInteger('fundo_id')->nullable();
            $table->unsignedBigInteger('fonte_id')->nullable();

            $table->string('name', 100);
            $table->char('birthdate', 15);
            $table->char('deathdate', 15);
            $table->string('phrase', 255)->nullable();
            $table->string('image', 150);
            $table->string('image_crop', 150);
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
            $table->foreign('placa_id')->references('id')->on('placas')->onDelete('set null');
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('set null');
            $table->foreign('moldura_id')->references('id')->on('molduras')->onDelete('set null');
            $table->foreign('fundo_id')->references('id')->on('fundos')->onDelete('set null');
            $table->foreign('fonte_id')->references('id')->on('fontes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
