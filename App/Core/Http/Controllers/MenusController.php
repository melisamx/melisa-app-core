<?php namespace App\Core\Http\Controllers;

use Melisa\Laravel\Http\Controllers\Controller;
use App\Core\Repositories\MenusOptionsRepository;
use App\Core\Logics\Menus\Sencha;

class MenusController extends Controller
{
    
    public function get(MenusOptionsRepository $menus, $key) {
        
        return response()->data($menus->getByMenuKey($key));
        
    }
    
    public function sencha(Sencha $menus, $key) {
        
        return response()->data($menus->generate($key));
        
    }
    
}
