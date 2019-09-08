<?php

namespace App\Http\Middleware\Tenant;

use Closure;
use App\Company;

class SetTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tenant = $this->resolveTenant(session('tenant'));

        if (!$tenant) {
            return $next($request);
        }

        if (!auth()->user()->companies->contains('id', $tenant->id)) {
            return redirect('/home');
        }

        return $next($request);
    }

    protected function resolveTenant($uuid)
    {
        return Company::where('uuid', $uuid)->first();
    }
}
