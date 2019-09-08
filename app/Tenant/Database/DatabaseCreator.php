<?php

namespace App\Tenant\Database;

use DB;
use App\Tenant\Models\Tenant;

class DatabaseCreator
{
    public function create(Tenant $tenant)
    {
        return DB::statement("
            CREATE DATABASE fresh_{$tenant->id}
        ");
    }
}
