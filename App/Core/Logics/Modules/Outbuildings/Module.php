<?php namespace App\Core\Logics\Modules\Outbuildings;

use Melisa\core\LogicBusiness;
use App\Core\Repositories\ModulesRepository;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Module
{
    use LogicBusiness;
    
    protected $modules;
    protected $urlServer;

    public function __construct(ModulesRepository $modules) {
        
        $this->modules = $modules;
        $this->urlServer = config('app.url');
        
    }
    
    public function get($keys = [], $onlyUrl = true) {
        
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
        
        if( count($keys) === 1) {
            
            return $onlyUrl ? reset($modules)['url'] : reset($modules);
            
        }
        
        return $onlyUrl ? array_column($modules, 'url') : $modules;
        
    }
    
    public function load($key) {
        
        static $loades = [];
        
        if( isset($loades[$key])) {
            
            return $loades[$key];
            
        }
        
        $module = $this->modules->getByKeyTask($key);
        
        if( $module === false) {

            return false;

        }
        
        $config = [
            'url'=>$module->url,
            'nameSpace'=>$module->nameSpace
        ];
        
        $loades [$key]= $config;

        return $config;
        
    }
    
}
