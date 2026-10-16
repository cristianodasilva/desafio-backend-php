<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa as alterações no banco de dados.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 30);
            $table->string('photo_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Desfaz as alterações no banco de dados.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};