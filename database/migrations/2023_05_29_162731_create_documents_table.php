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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('societe_id');
            $table->string('libelle')->unique();
            $table->string('nom_fichier');
            $table->date('date')->default(null);

            $table->foreign('type_id')->references('id')->on('type_documents')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
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
        Schema::dropIfExists('documents');
    }
};
