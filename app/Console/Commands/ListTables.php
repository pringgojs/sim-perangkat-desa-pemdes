<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DatabaseService;
use Illuminate\Support\Facades\DB;

class ListTables extends Command
{
    protected $signature = 'db:list-tables {--database=}';

    protected $description = 'List all tables in the database, ordered alphabetically';

    public function handle()
    {
        $database = $this->option('database') ?? 'db_alim';

        $service = new DatabaseService;
        $tables = $service->getTables('database');
        
        $this->info("Tables in database '{$database}':");

        foreach ($tables as $table) {
            $this->line($table->table_name);
        }
    }
}
