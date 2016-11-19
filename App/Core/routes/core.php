<?php

Route::get('/sencha/{version}/{path}', 'SenchaController@file')->where([
    'version'=>'(\d\.\d\.\d)',
    'path'=>'(.*)'
]);
