<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('actualites')) {
            Schema::create('actualites', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('extrait');
                $table->longText('description');
                $table->longText('content')->nullable();
                $table->string('category')->default('actualite');
                $table->string('image')->nullable();
                $table->boolean('published')->default(false);
                $table->string('statut')->default('brouillon');
                $table->timestamp('date_publication')->nullable();
                $table->boolean('featured')->default(false);
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('team_id')->nullable();
                $table->timestamps();
            });

            return;
        }

        $driver = DB::getDriverName();

        /*
        |--------------------------------------------------------------------------
        | Corriger la colonne statut
        |--------------------------------------------------------------------------
        | PostgreSQL accepte DROP CONSTRAINT / ALTER COLUMN TYPE.
        | MySQL n'accepte pas cette syntaxe, donc on utilise MODIFY.
        */

        if (Schema::hasColumn('actualites', 'statut')) {
            if ($driver === 'pgsql') {
                DB::statement('ALTER TABLE actualites DROP CONSTRAINT IF EXISTS actualites_statut_check');
                DB::statement('ALTER TABLE actualites ALTER COLUMN statut TYPE VARCHAR(255)');
                DB::statement("ALTER TABLE actualites ALTER COLUMN statut SET DEFAULT 'brouillon'");
            }

            if ($driver === 'mysql') {
                DB::statement("ALTER TABLE `actualites` MODIFY `statut` VARCHAR(255) NOT NULL DEFAULT 'brouillon'");
            }
        } else {
            Schema::table('actualites', function (Blueprint $table) {
                $table->string('statut')->default('brouillon');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Ajouter les colonnes manquantes
        |--------------------------------------------------------------------------
        */

        Schema::table('actualites', function (Blueprint $table) {
            if (! Schema::hasColumn('actualites', 'content')) {
                $table->longText('content')->nullable();
            }

            if (! Schema::hasColumn('actualites', 'category')) {
                $table->string('category')->default('actualite');
            }

            if (! Schema::hasColumn('actualites', 'featured')) {
                $table->boolean('featured')->default(false);
            }

            if (! Schema::hasColumn('actualites', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }

            if (! Schema::hasColumn('actualites', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }

            if (! Schema::hasColumn('actualites', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
            }

            if (! Schema::hasColumn('actualites', 'team_id')) {
                $table->unsignedBigInteger('team_id')->nullable();
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Sécuriser les données existantes
        |--------------------------------------------------------------------------
        */

        if (
            Schema::hasColumn('actualites', 'content') &&
            Schema::hasColumn('actualites', 'description')
        ) {
            DB::table('actualites')
                ->whereNull('content')
                ->update([
                    'content' => DB::raw('description'),
                ]);
        }

        if (
            Schema::hasColumn('actualites', 'statut') &&
            Schema::hasColumn('actualites', 'published')
        ) {
            DB::table('actualites')
                ->where('statut', 'publié')
                ->update([
                    'published' => true,
                ]);
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('actualites')) {
            return;
        }

        Schema::table('actualites', function (Blueprint $table) {
            if (Schema::hasColumn('actualites', 'content')) {
                $table->dropColumn('content');
            }

            if (Schema::hasColumn('actualites', 'category')) {
                $table->dropColumn('category');
            }

            if (Schema::hasColumn('actualites', 'featured')) {
                $table->dropColumn('featured');
            }

            if (Schema::hasColumn('actualites', 'meta_title')) {
                $table->dropColumn('meta_title');
            }

            if (Schema::hasColumn('actualites', 'meta_description')) {
                $table->dropColumn('meta_description');
            }

            if (Schema::hasColumn('actualites', 'user_id')) {
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('actualites', 'team_id')) {
                $table->dropColumn('team_id');
            }
        });
    }
};
