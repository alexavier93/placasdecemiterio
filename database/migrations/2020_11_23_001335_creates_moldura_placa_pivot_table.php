<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesMolduraPlacaPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moldura_placa', function (Blueprint $table) {
            $table->unsignedBigInteger('placa_id');
            $table->unsignedBigInteger('moldura_id')->nullable();

            $table->foreign('placa_id')->references('id')->on('placas')->onDelete('cascade');
            $table->foreign('moldura_id')->references('id')->on('molduras')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moldura_placa');
    }
}
