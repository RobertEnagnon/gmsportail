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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('nom_fichier');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('societe_id');
            $table->date('date')->nullable();

            $table->foreign('client_id')->references('id')->on('clients')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('societe_id')->references('id')->on('societes')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
