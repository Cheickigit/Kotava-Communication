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

        // PostgreSQL : enlever l'ancien CHECK de enum si Laravel l'a créé.
        DB::statement('ALTER TABLE actualites DROP CONSTRAINT IF EXISTS actualites_statut_check');

        if (Schema::hasColumn('actualites', 'statut')) {
            DB::statement('ALTER TABLE actualites ALTER COLUMN statut TYPE VARCHAR(255)');
            DB::statement("ALTER TABLE actualites ALTER COLUMN statut SET DEFAULT 'brouillon'");
        }

        Schema::table('actualites', function (Blueprint $table) {
            if (! Schema::hasColumn('actualites', 'content')) {
                $table->longText('content')->nullable()->after('description');
            }

            if (! Schema::hasColumn('actualites', 'category')) {
                $table->string('category')->default('actualite')->after('content');
            }

            if (! Schema::hasColumn('actualites', 'featured')) {
                $table->boolean('featured')->default(false)->after('date_publication');
            }

            if (! Schema::hasColumn('actualites', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('featured');
            }

            if (! Schema::hasColumn('actualites', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }

            if (! Schema::hasColumn('actualites', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('meta_description');
            }

            if (! Schema::hasColumn('actualites', 'team_id')) {
                $table->unsignedBigInteger('team_id')->nullable()->after('user_id');
            }
        });

        DB::table('actualites')
            ->whereNull('content')
            ->update([
                'content' => DB::raw('description'),
            ]);

        DB::table('actualites')
            ->where('statut', 'publié')
            ->update([
                'published' => true,
            ]);
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