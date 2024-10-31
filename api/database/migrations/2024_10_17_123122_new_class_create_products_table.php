<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Crea la columna id como llave primaria
            $table->string('name'); // Crea la columna name
            $table->text('description')->nullable(); // Crea la columna description
            $table->decimal('price', 8, 2); // Crea la columna price
            $table->date('date_add')->nullable(); // Crea la columna date_add
            $table->timestamps(); // Crea las columnas created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('products'); // Elimina la tabla si se hace un rollback
    }
};

