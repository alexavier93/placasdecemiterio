<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesFontePlacaPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fonte_placa', function (Blueprint $table) {
            $table->unsignedBigInteger('placa_id');
            $table->unsignedBigInteger('fonte_id')->nullable();

            $table->foreign('placa_id')->references('id')->on('placas')->onDelete('cascade');
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
        //
    }
}
