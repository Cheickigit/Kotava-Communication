<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('leads', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('email');
        $table->string('telephone')->nullable();
        $table->string('entreprise')->nullable();
        $table->text('message')->nullable();
        $table->string('status')->default('nouveau'); // nouveau, en_cours, traité
        $table->string('service')->nullable(); // Service demandé
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
