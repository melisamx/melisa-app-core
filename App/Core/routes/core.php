<?php

Route::get('sencha/{version}/{path}', 'SenchaController@file')->where([
    'version'=>'(\d*\.\d*\.\d*)',
    'path'=>'(.*)'
]);

Route::get('menus/{key}', 'MenusController@hierarchical');
Route::get('menus/{key}/records', 'MenusController@records');
