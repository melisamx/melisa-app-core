<?php namespace App\Core\Logics\Modules\Outbuildings;

use Illuminate\Filesystem\FileNotFoundException;
use Melisa\core\LogicBusiness;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class View
{
    use LogicBusiness;
    
    public function get($keys = []) {
        
        if( is_string($keys)) {
            
            $keys = [ $keys ];
            
        }
        
        $this->debug('loading {c} views: {i}', [
            'c'=>count($keys),
            'i'=>implode(',', $keys)
        ]);
        
        $views = [];
        $flag = true;
        
        foreach($keys as $key) {
            
            $view = $this->load($key);
            
            if( !$view) {
                
                $flag = false;
                break;
                
            }
            
            $views [$key]= $view;
            
        }
        
        if( !$flag) {
            
            return null;
            
        }
        
        return count($views) ? reset($views) : $views ;
        
    }
    
    public function load($key, $data = []) {
        
        $flag = true;
        
        try {
            
            $view = view($key, $data);
            
        } catch (FileNotFoundException $exception) {

            $flag = $this->error('The view {k} no exist', [
                'v'=>$key
            ]);

        }
        
        return $flag ? $view->render() : false;
        
    }
    
}
