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
        Schema::create('plannings', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->text('detail')->nullable()->default(null);
            $table->date('date');
            $table->date("date_fin")->nullable();

            $table->boolean('repete')->nullable()->default(false);
            $table->string('periodicite')->nullable()->default(null);
            // $table->string('repetition')->nullable()->default(null);

            $table->boolean('is_done')->nullable()->default(false);
            $table->date('se_termine_le')->nullable()->default(null);
            $table->string('se_termine_apres')->nullable()->default(null);

            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('societe_id')->nullable();

            $table->string('couleur');
            $table->timestamps();


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
        Schema::dropIfExists('plannings');
    }
};
