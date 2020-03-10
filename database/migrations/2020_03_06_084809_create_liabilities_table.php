<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liabilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('game_id');
            $table->string('name');
            $table->integer('type')->nullable();
            $table->integer('cash_flow')->nullable();
            $table->integer('child_number')->nullable();
            $table->integer('loan_size')->nullable();
            $table->timestamps();

            $table->foreign('game_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liabilities');
    }
}
