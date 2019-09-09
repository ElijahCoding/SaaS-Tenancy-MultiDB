<?php

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/projects', 'Tenant\ProjectController');
