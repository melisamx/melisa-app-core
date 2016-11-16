<?php 

Route::group([
    'prefix'=>'v1',
//    'middleware'=>'auth.basic',
    'namespace' =>'v1'
], function() {
    
    Route::group([
        'prefix'=>'cache'
    ], function() {
       
        Route::get('/', 'CacheController@index');
        
    });
    
});
