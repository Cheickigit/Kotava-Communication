<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('realisations', function (Blueprint $table) {
            // Ajouter les champs manquants
            if (!Schema::hasColumn('realisations', 'slug')) {
                $table->string('slug')->unique()->nullable()->after('title');
            }

            if (!Schema::hasColumn('realisations', 'short_description')) {
                $table->text('short_description')->nullable()->after('description');
            }

            if (!Schema::hasColumn('realisations', 'category')) {
                $table->string('category')->default('web')->after('client');
            }

            if (!Schema::hasColumn('realisations', 'service_type')) {
                $table->string('service_type')->nullable()->after('category');
            }

            if (!Schema::hasColumn('realisations', 'featured')) {
                $table->boolean('featured')->default(false)->after('published');
            }

            if (!Schema::hasColumn('realisations', 'budget')) {
                $table->decimal('budget', 12, 2)->nullable()->after('featured');
            }

            if (!Schema::hasColumn('realisations', 'start_date')) {
                $table->date('start_date')->nullable()->after('budget');
            }

            if (!Schema::hasColumn('realisations', 'end_date')) {
                $table->date('end_date')->nullable()->after('start_date');
            }

            if (!Schema::hasColumn('realisations', 'testimonial')) {
                $table->text('testimonial')->nullable()->after('end_date');
            }

            if (!Schema::hasColumn('realisations', 'testimonial_author')) {
                $table->string('testimonial_author')->nullable()->after('testimonial');
            }

            if (!Schema::hasColumn('realisations', 'gallery')) {
                $table->json('gallery')->nullable()->after('testimonial_author');
            }

            if (!Schema::hasColumn('realisations', 'metrics')) {
                $table->json('metrics')->nullable()->after('gallery');
            }

            if (!Schema::hasColumn('realisations', 'cover_image')) {
                $table->string('cover_image')->nullable()->after('image');
            }

            if (!Schema::hasColumn('realisations', 'client_logo')) {
                $table->string('client_logo')->nullable()->after('client');
            }
        });
    }

    public function down(): void
    {
        Schema::table('realisations', function (Blueprint $table) {
            // Supprimer les colonnes ajoutées
            $columnsToDrop = [
                'slug', 'short_description', 'category', 'service_type',
                'featured', 'budget', 'start_date', 'end_date',
                'testimonial', 'testimonial_author', 'gallery', 'metrics',
                'cover_image', 'client_logo'
            ];

            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('realisations', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
