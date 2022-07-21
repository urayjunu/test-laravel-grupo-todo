<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('subcategoria_id');
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });

        DB::table("categorias")
            ->insert([
                "subcategoria_id" => 0,
                "nombre" => "Autos",
                "descripcion" => "Autos 0 km"
               
                ],[
                "subcategoria_id" => 0,
                "nombre" => "Motos",
                "descripcion" => "Motos 0 km"
               
                ]

            );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
