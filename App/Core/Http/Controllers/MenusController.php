<?php namespace App\Core\Http\Controllers;

use Melisa\Laravel\Http\Controllers\Controller;
use App\Core\Repositories\MenusOptionsRepository;

class MenusController extends Controller
{
    
    public function get(MenusOptionsRepository $menus, $key) {
        
        return $menus->getByMenuKey($key);
        
    }
    
}
