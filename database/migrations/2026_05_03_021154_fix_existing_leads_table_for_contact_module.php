<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('leads')) {
            return;
        }

        Schema::table('leads', function (Blueprint $table) {
            if (! Schema::hasColumn('leads', 'is_read')) {
                $table->boolean('is_read')->default(false)->after('status');
            }

            if (! Schema::hasColumn('leads', 'source')) {
                $table->string('source')->nullable()->after('service');
            }

            if (! Schema::hasColumn('leads', 'ip_address')) {
                $table->string('ip_address')->nullable()->after('source');
            }

            if (! Schema::hasColumn('leads', 'user_agent')) {
                $table->text('user_agent')->nullable()->after('ip_address');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('leads')) {
            return;
        }

        Schema::table('leads', function (Blueprint $table) {
            if (Schema::hasColumn('leads', 'is_read')) {
                $table->dropColumn('is_read');
            }

            if (Schema::hasColumn('leads', 'source')) {
                $table->dropColumn('source');
            }

            if (Schema::hasColumn('leads', 'ip_address')) {
                $table->dropColumn('ip_address');
            }

            if (Schema::hasColumn('leads', 'user_agent')) {
                $table->dropColumn('user_agent');
            }
        });
    }
};