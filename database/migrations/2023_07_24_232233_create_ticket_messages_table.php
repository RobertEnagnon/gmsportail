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
        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->text('content');
            $table->string('fichiers')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('users')
                ->onDelete('set null');
            $table->foreign('ticket_id')->references('id')->on('tickets')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_messages');
    }
};
