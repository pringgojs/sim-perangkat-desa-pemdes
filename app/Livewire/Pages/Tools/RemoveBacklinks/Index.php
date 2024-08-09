<?php

namespace App\Livewire\Pages\Tools\RemoveBacklinks;

use Livewire\Component;
use App\Services\DatabaseService;
use Illuminate\Support\Facades\Artisan;

class Index extends Component
{
    public $database;
    public $table;
    public $column;

    public $databases = [];
    public $tables = [];
    public $columns = [];

    public $output;
    public function mount()
    {
        $service = new DatabaseService;
        $this->databases = $service->showDatabases();
    }

    public function getTables()
    {
        if (!$this->database) return;

        $service = new DatabaseService;
        $this->tables = $service->getTables($this->database);
    }

    public function getColumns()
    {
        if (!$this->database) return;
        if (!$this->table) return;

        $service = new DatabaseService;
        $this->columns = $service->getColumns($this->database, $this->table);
    }

    public function process()
    {
        
        if (!$this->database) return;
        if (!$this->table) return;
        if (!$this->column) return;
        
        /* process remove backlinks */

        Artisan::call('remove:backlinks', [
            'column' => $this->column,
            'table' => $this->table,
            'dbname' => $this->database
        ]);

        $this->output = Artisan::output();
    }

    public function render()
    {
        return view('livewire.pages.tools.remove-backlinks.index');
    }
}
