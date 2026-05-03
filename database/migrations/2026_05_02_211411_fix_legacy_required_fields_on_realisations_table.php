<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $table = 'realisations';

    private array $nullableColumns = [
        'media',
        'categorie_id',
        'sector',
        'country',
        'type',
        'completion_date',
        'summary',
        'context',
        'solution',
        'results',
    ];

    public function up(): void
    {
        if (! Schema::hasTable($this->table)) {
            return;
        }

        $driver = DB::getDriverName();

        foreach ($this->nullableColumns as $column) {
            if (! Schema::hasColumn($this->table, $column)) {
                continue;
            }

            if ($driver === 'pgsql') {
                DB::statement("ALTER TABLE {$this->table} ALTER COLUMN {$column} DROP NOT NULL");
            }

            if ($driver === 'mysql') {
                $this->mysqlMakeColumnNullable($this->table, $column);
            }
        }

        if ($driver === 'pgsql' && Schema::hasColumn($this->table, 'media')) {
            DB::statement("ALTER TABLE {$this->table} ALTER COLUMN media SET DEFAULT '[]'::json");
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable($this->table)) {
            return;
        }

        $driver = DB::getDriverName();

        if ($driver === 'pgsql' && Schema::hasColumn($this->table, 'media')) {
            DB::statement("ALTER TABLE {$this->table} ALTER COLUMN media DROP DEFAULT");
        }

        if ($driver === 'mysql' && Schema::hasColumn($this->table, 'media')) {
            DB::statement("ALTER TABLE `{$this->table}` ALTER `media` DROP DEFAULT");
        }
    }

    private function mysqlMakeColumnNullable(string $table, string $column): void
    {
        $definition = DB::selectOne(
            "
            SELECT COLUMN_TYPE AS column_type
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = ?
              AND COLUMN_NAME = ?
            ",
            [$table, $column]
        );

        if (! $definition) {
            return;
        }

        DB::statement("ALTER TABLE `{$table}` MODIFY `{$column}` {$definition->column_type} NULL");
    }
};
