<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantDatabaseCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Artisan;

class SetUpTenantDatabase
{
    /**
     * Handle the event.
     *
     * @param  TenantDatabaseCreated  $event
     * @return void
     */
    public function handle(TenantDatabaseCreated $event)
    {    
        Artisan::call('tenants:migrate', [
            '--tenants' => [$event->tenant->id]
        ]);
    }
}
