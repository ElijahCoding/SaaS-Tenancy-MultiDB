<?php

namespace App;

use App\TenantConnection;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function tenantConnection()
    {
        return $this->hasOne(TenantConnection::class, 'company_id', 'id');
    }
}
