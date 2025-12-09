<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client');
            $table->string('secteur');
            $table->string('pays');
            $table->string('type');
            $table->year('date_realisation');
            $table->text('resume');
            $table->text('description');
            $table->text('solution');
            $table->text('resultats');
            $table->string('client_testimonial')->nullable();
            $table->string('client_testimonial_name')->nullable();
            $table->string('client_testimonial_position')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realisations');
    }
}
