<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTenantDatabase
{
    /**
     * Handle the event.
     *
     * @param  TenantWasCreated  $event
     * @return void
     */
    public function handle(TenantWasCreated $event)
    {
        //
    }
}
