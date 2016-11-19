<?php namespace App\Core\Http\Controllers;

use Melisa\Laravel\Http\Controllers\Controller;
use App\Core\Logics\Sencha\File;

class SenchaController extends Controller
{
    
    public function file(File $view, $version, $path) {
        
        return $view->render($path);
        
    }
    
}
