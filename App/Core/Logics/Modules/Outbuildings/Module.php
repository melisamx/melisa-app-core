<?php namespace App\Core\Logics\Modules\Outbuildings;

use Melisa\core\LogicBusiness;
use App\Core\Models\Modules;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Module
{
    use LogicBusiness;
    
    protected $modules;

    public function __construct(Modules $modules) {
        
        $this->modules = $modules;
        
    }
    
    public function get($keys = []) {
        
        if( is_string($keys)) {
            
            $keys = [ $keys ];
            
        }
        
        $this->debug('loading {c} modules: {i}', [
            'c'=>count($keys),
            'i'=>implode(',', $keys)
        ]);
        
        $modules = [];
        $flag = true;
        
        foreach($keys as $key) {
            
            $menu = $this->load($key);
            
            if( $menu) {
                
                $modules [$key]= $menu;
                continue;
                
            }
            
            $flag = false;
            break;
            
        }
        
        if( !$flag) {
            
            return null;
            
        }
        
        return $modules[$key];
        
    }
    
    public function load($key) {
        
        static $loades = [];
        
        if( isset($loades[$key])) {
            
            return $loades[$key];
            
        }
        
        $module = $this->modules->find($key);
        
        if( $module === false) {

            return false;

        }
        
        $loades [$key]= $module;

        return $module;
        
    }
    
}
