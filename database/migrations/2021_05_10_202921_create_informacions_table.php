<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(
            'informacions', 
            function (Blueprint $table) {
                $table->id();
                $table->string("nombres");
                $table->string("apellidos");
                $table->string("direcion");
                $table->date("fecha_nac");
                $table->string("sexo");
                $table->unsignedBigInteger('usuario_id');
                $table->foreign('usuario_id')
                ->references('id')
                ->on('users');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('informacions');
    }
}