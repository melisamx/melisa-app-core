<?php

namespace App\Core\Http\Controllers;

use Melisa\Laravel\Http\Controllers\Controller;
use App\Core\Logics\Sencha\File;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class SenchaController extends Controller
{
    
    public function file(File $view, $version, $path)
    {
        /* 30 dias */
        $expireTime = 2592000;
        $expiration = time() + $expireTime;
        
        return response($view->render($path))
            ->withHeaders([
                'Content-Type'=>'application/javascript',
                'Expires'=>gmdate('D, d M Y H:i:s', $expiration) . ' GMT',
                'Cache-control'=>' max-age=' . $expireTime . ', public'
            ]);        
    }
    
}
