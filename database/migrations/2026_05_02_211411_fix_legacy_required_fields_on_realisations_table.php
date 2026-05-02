<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('realisations')) {
            if (Schema::hasColumn('realisations', 'media')) {
                DB::statement("ALTER TABLE realisations ALTER COLUMN media DROP NOT NULL");
                DB::statement("ALTER TABLE realisations ALTER COLUMN media SET DEFAULT '[]'::json");
            }

            if (Schema::hasColumn('realisations', 'categorie_id')) {
                DB::statement("ALTER TABLE realisations ALTER COLUMN categorie_id DROP NOT NULL");
            }

            if (Schema::hasColumn('realisations', 'sector')) {
                DB::statement("ALTER TABLE realisations ALTER COLUMN sector DROP NOT NULL");
            }

            if (Schema::hasColumn('realisations', 'country')) {
                DB::statement("ALTER TABLE realisations ALTER COLUMN country DROP NOT NULL");
            }

            if (Schema::hasColumn('realisations', 'type')) {
                DB::statement("ALTER TABLE realisations ALTER COLUMN type DROP NOT NULL");
            }

            if (Schema::hasColumn('realisations', 'completion_date')) {
                DB::statement("ALTER TABLE realisations ALTER COLUMN completion_date DROP NOT NULL");
            }

            if (Schema::hasColumn('realisations', 'summary')) {
                DB::statement("ALTER TABLE realisations ALTER COLUMN summary DROP NOT NULL");
            }

            if (Schema::hasColumn('realisations', 'context')) {
                DB::statement("ALTER TABLE realisations ALTER COLUMN context DROP NOT NULL");
            }

            if (Schema::hasColumn('realisations', 'solution')) {
                DB::statement("ALTER TABLE realisations ALTER COLUMN solution DROP NOT NULL");
            }

            if (Schema::hasColumn('realisations', 'results')) {
                DB::statement("ALTER TABLE realisations ALTER COLUMN results DROP NOT NULL");
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('realisations')) {
            if (Schema::hasColumn('realisations', 'media')) {
                DB::statement("ALTER TABLE realisations ALTER COLUMN media DROP DEFAULT");
            }
        }
    }
};