<?php namespace App\Core\Logics\Modules\Outbuildings;

use Melisa\core\LogicBusiness;
use App\Core\Logics\Menus\Hierarchical;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Menu
{
    use LogicBusiness;
    
    protected $menus;

    public function __construct(Hierarchical $menus) {
        
        $this->menus = $menus;
        
    }
    
    public function get($keys = []) {
        
        if( is_string($keys)) {
            
            $keys = [ $keys ];
            
        }
        
        $this->debug('loading {c} menus: {i}', [
            'c'=>count($keys),
            'i'=>implode(',', $keys)
        ]);
        
        $menus = [];
        $flag = true;
        
        foreach($keys as $key) {
            
            $menu = $this->load($key);
            
            if( $menu) {
                
                $menus [$key]= $menu;
                continue;
                
            }
            
            $flag = false;
            break;
            
        }
        
        if( !$flag) {
            
            return null;
            
        }
        
        return $menus[$key];
        
    }
    
    public function load($key) {
        
        static $loades = [];
        
        if( isset($loades[$key])) {
            
            return $loades[$key];
            
        }
        
        $menu = $this->menus->get($key);
        
        if( $menu === false) {

            return false;

        }
        
        $loades [$key]= $menu;

        return $menu;
        
    }
    
}
