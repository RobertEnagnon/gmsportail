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
        //     $table->text('message');
            $table->dateTime('date')->nullable()->default(null);
            $table->string('fichiers')->nullable()->default(null);
            $table->enum('status', ['Ouvert', 'Répondu', 'Réponse du client', 'Fermé'])->default('Ouvert');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('priorite_id')->nullable();
            $table->unsignedBigInteger('societe_id')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')
                    ->onDelete('set null');
            $table->foreign('service_id')->references('id')->on('services')
                    ->onDelete('set null');
            $table->foreign('priorite_id')->references('id')->on('priorites')
                    ->onDelete('set null');
            $table->foreign('societe_id')->references('id')->on('societes')
                    ->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('set null');
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
