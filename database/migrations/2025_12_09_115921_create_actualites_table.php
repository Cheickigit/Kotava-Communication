<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActualitesTable extends Migration
{
    public function up()
    {
        Schema::create('actualites', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('extrait');
            $table->text('description');
            $table->string('image')->nullable();
            $table->boolean('published')->default(false); // Utiliser published
            $table->enum('statut', ['publié', 'brouillon'])->default('brouillon');
            $table->timestamp('date_publication')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('actualites');
    }
}
