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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('client_id')->nullable()->default(null);
            $table->boolean('is_client')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->dateTime('derniere_con')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();


            // $table->foreign('client_id')->references('id')->on('clients')
            // ->onUpdate('restrict')
            // ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
