<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('realisations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client');
            $table->string('sector');
            $table->string('country');
            $table->string('type');
            $table->date('completion_date');
            $table->text('summary');
            $table->text('description');
            $table->text('context');
            $table->text('solution');
            $table->text('results');
            $table->string('client_testimony')->nullable();
            $table->json('media');
            $table->string('image')->nullable();
            $table->boolean('published')->default(false);
            $table->string('statut')->default('draft');
            $table->boolean('featured')->default(false);
            $table->unsignedBigInteger('categorie_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('realisations');
    }
};
