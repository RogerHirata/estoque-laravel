<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            //Chave estrangeira para a tabela 

            //onDelete = Caso uma categoria seja deletada, todos os produtos relacionados a ela também serão deletados
            
            //*Analisa o nome da coluna (category_id): Ele pega a primeira parte (category), coloca no plural em inglês (categories) e entende que essa coluna precisa apontar para a tabela categories. O método constrained(): Valida que a coluna category_id da tabela atual aponta diretamente para a coluna id da tabela categories. *//
            $table->integer('estoque')->default(0);
            $table->string('name');
            $table->decimal('preco',10,2);
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
