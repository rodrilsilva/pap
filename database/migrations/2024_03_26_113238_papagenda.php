<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('localidade', function (Blueprint $table) {
            $table->id('id');
            $table->string('cod_postal');
            $table->text('localidade');

        });

        Schema::create('colaborador', function (Blueprint $table) {
            $table->id('id');
            $table->string('nome');
            $table->integer('gen');
            $table->text('avatar');
            $table->unsignedBigInteger('users_id');  
            $table->foreign('users_id')->references('id')->on('users');      
        
        });

        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id');
            $table->text('nome');
            $table->unsignedTinyInteger('gen')->nullable();
            $table->text('morada')->nullable();
            $table->text('cod_postal')->nullable();
            $table->unsignedBigInteger('localidade_id')->nullable();
            $table->foreign('localidade_id')->references('id')->on('localidade')->nullable();
            $table->text('email')->nullable();
            $table->integer('tlm')->nullable();
            $table->string('nif', 9)->nullable();
            $table->datetime('dh')->nullable();
            $table->text('avatar')->nullable();
            $table->text('observacoes')->nullable();
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')->nullable();
            $table->timestamps();
        });

        Schema::create('tipo_servico', function (Blueprint $table) {
            $table->id('id');
            $table->text('nome');
            $table->integer('duracao');
            $table->decimal('preco');
            $table->string('icone');
            $table->string('cor');
        });

        Schema::create('marcacao', function (Blueprint $table) {
            $table->id('id');
            $table->datetime('data_hora');
            $table->unsignedTinyInteger('estado');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->unsignedBigInteger('colaborador_id'); //adicionadas para teste
            $table->foreign('colaborador_id')->references('id')->on('colaborador'); //adicionadas para teste
            $table->unsignedBigInteger('tipo_servico_id'); //adicionadas para teste
            $table->foreign('tipo_servico_id')->references('id')->on('tipo_servico'); //adicionadas para teste
            $table->text('obs');
        });

        Schema::create('produto', function (Blueprint $table) {
            $table->id('id');
            $table->text('nome');
            $table->decimal('preco');
            $table->string('icone');
            $table->string('cor');
        });

        Schema::create('fatura', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('marcacao_id');
            $table->foreign('marcacao_id')->references('id')->on('marcacao');
            $table->unsignedBigInteger('servico_id');
            $table->foreign('servico_id')->references('id')->on('tipo_servico');
            $table->unsignedBigInteger('colaborador_id');
            $table->foreign('colaborador_id')->references('id')->on('colaborador');
            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')->on('produto');
            $table->decimal('preco_final', 10, 2);
            $table->unsignedTinyInteger('desconto');
            $table->decimal('qtd');
        });


        Schema::create('notificacao', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->unsignedBigInteger('marcacao_id');
            $table->foreign('marcacao_id')->references('id')->on('marcacao');
            $table->text('mensagem');
            $table->datetime( 'dh_envio');
            $table->unsignedTinyInteger( 'tipo_envio');
        });
        

        Schema::create('imagem', function (Blueprint $table) {
            $table->id('id');
            $table->text('ficheiro');
            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')->on('produto');
        });

        Schema::create('tipo_servico_colaborador', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_servico_id');
            $table->foreign('tipo_servico_id')->references('id')->on('tipo_servico');
            $table->unsignedBigInteger('colaborador_id');
            $table->foreign('colaborador_id')->references('id')->on('colaborador');
            $table->primary(['tipo_servico_id', 'colaborador_id']);
        });

        Schema::create('config', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('telefone')->nullable();
            $table->integer('telemovel')->nullable();
            $table->string('morada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tipo_servico_colaborador');
        Schema::dropIfExists('imagem');
        Schema::dropIfExists('produto');
        Schema::dropIfExists('tipo_servico');
        Schema::dropIfExists('cliente');
        Schema::dropIfExists('notificacao');
        Schema::dropIfExists('fatura');
        Schema::dropIfExists('marcacao');
        Schema::dropIfExists('colaborador');
        Schema::dropIfExists('config');
        Schema::dropIfExists('localidade');
    }
};
