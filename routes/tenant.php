<?php
use App\Tenant\Manager;

Route::get('/test', function () {
    dd(app(Manager::class)->getTenant());
});
