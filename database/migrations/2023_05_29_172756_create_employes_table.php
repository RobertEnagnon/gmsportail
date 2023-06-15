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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->string('nom');
            $table->string('prenom');
            $table->string('cin');
            $table->string('cnss');
            $table->unsignedBigInteger('site_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('societe_id');
            $table->date('date')->default(null);

            $table->foreign('site_id')->references('id')->on('sites')
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
        Schema::dropIfExists('employes');
    }
};
