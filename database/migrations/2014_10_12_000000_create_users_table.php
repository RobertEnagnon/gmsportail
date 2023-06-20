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
            $table->integer('client_id')->nullable()->unsigned()->index();
            $table->boolean('is_client')->nullable()->default(false);
            $table->boolean('is_admin')->nullable()->default(false);
            $table->dateTime('derniere_con')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();


            $table->foreign('client_id')->references('id')->on('clients')
            ->onDelete('restrict');
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
