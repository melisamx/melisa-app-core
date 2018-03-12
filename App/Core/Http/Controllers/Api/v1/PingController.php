<?php

namespace App\Core\Http\Controllers\Api\v1;

use Melisa\Laravel\Http\Controllers\Controller;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PingController extends Controller
{
    
    public function index()
    {
        return response()->data([
            'keyapp'=>config('app.keyapp')
        ]);
    }
    
}
