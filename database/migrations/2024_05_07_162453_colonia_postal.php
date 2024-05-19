<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Coloniapostal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colonia_postals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('colonia_id')->nullable()
            ->constrained()
            ->onDelete('set null');

            $table->foreignId('codigo_postal_id')->nullable()
            ->constrained()
            ->onDelete('set null');

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
        Schema::dropIfExists('colonia_postals');
    }
}
