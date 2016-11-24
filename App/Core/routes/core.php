<?php

Route::get('sencha/{version}/{path}', 'SenchaController@file')->where([
    'version'=>'(\d\.\d\.\d)',
    'path'=>'(.*)'
]);

Route::get('menus/{key}', 'MenusController@get');
Route::get('menus/{key}/sencha', 'MenusController@sencha');
