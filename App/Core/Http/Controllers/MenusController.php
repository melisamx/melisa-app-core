<?php namespace App\Core\Http\Controllers;

use Melisa\Laravel\Http\Controllers\Controller;
use App\Core\Repositories\MenusOptionsRepository;
use App\Core\Logics\Menus\Hierarchical;

class MenusController extends Controller
{
    
    public function records(MenusOptionsRepository $menus, $key) {
        
        return response()->data($menus->getByMenuKey($key));
        
    }
    
    public function hierarchical(Hierarchical $menus, $key) {
        
        return response()->data($menus->generate($key));
        
    }
    
}
