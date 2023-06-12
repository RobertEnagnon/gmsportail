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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('message');
            $table->date('date')->nullable()->default(null);
            $table->string('fichier')->nullable()->default(null);
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('priorite_id');
            $table->unsignedBigInteger('societe_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('client_id')->references('id')->on('clients')
                    ->onUpdate('restrict')
                    ->onDelete('restrict');
            $table->foreign('service_id')->references('id')->on('services')
                    ->onUpdate('restrict')
                    ->onDelete('restrict');
            $table->foreign('priorite_id')->references('id')->on('priorites')
                    ->onUpdate('restrict')
                    ->onDelete('restrict');
            $table->foreign('societe_id')->references('id')->on('societes')
                    ->onUpdate('restrict')
                    ->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('restrict')
                    ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
