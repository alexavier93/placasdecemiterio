<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesFundoPlacaPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundo_placa', function (Blueprint $table) {
            $table->unsignedBigInteger('placa_id');
            $table->unsignedBigInteger('fundo_id')->nullable();

            $table->foreign('placa_id')->references('id')->on('placas')->onDelete('cascade');
            $table->foreign('fundo_id')->references('id')->on('fundos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
