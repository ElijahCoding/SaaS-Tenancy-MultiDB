<?php

namespace App\Console\Commands\Tenant;

use App\Company;
use App\Tenant\Database\DatabaseManager;
use Illuminate\Console\Command;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Database\Console\Migrations\MigrateCommand;

class Migrate extends MigrateCommand
{
    protected $db;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations for tenants.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Migrator $migrator, DatabaseManager $db)
    {
        parent::__construct($migrator);

        $this->setName('tenants:migrate');

        $this->db = $db;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->confirmToProceed()) {
            return;
        }

        $this->input->setOption('database', 'tenant');

        $tenants = Company::get();

        $tenants->each(function ($tenant) {
            $this->db->createConnection($tenant);
            $this->db->connectToTenant();

            parent::handle();

            $this->db->purge();
        });
    }

    protected function getMigrationPaths()
    {
        return [database_path('migrations/tenant')];
    }
}
