<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCooperadosModelsTable extends Migration
{
    public function up()
    {
        Schema::create('cooperados', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpfcnpj', 14)->unique(); // Limitando a 14 caracteres e único
            $table->date('datafundacao'); // Armazenando apenas a data
            $table->decimal('rendafaturamento', 10, 2); // Número decimal (até 10 dígitos, com 2 decimais)
            $table->string('telefone')->nullable(); // Opcional, pode ser nulo
            $table->string('email')->nullable(); // Opcional, pode ser nulo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cooperados');
    }
}
