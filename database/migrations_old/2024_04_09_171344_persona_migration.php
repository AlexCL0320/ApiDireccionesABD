<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PersonaMigration extends Migration
{
    public function up()
    {
        Schema::create('Personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('apellido_p');
            $table->text('apellido_m');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('Personas');
    }
}
