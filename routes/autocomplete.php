<?php

use App\Sue001;
use App\Sue031;

Route::get('autocomplete/demo', function () {
    return view('components/autocomplete_demo');
});

Route::get('autocomplete/users', function () {
    $term = Request::get('term');
    return Sue001::findByNameOrEmail($term);
});

Route::get('autocomplete/novedades', function () {
    $term = Request::get('term');
    return Sue031::findByNameOrEmail($term);
});
