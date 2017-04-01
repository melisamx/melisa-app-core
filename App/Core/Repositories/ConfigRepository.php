<?php namespace App\Core\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class ConfigRepository extends Repository
{
    
    public function model() {        
        return 'App\Core\Models\Config';        
    }
    
    public function get($appKey = null)
    {
        
        if( is_null($appKey)) {
            $appKey = config('app.keyapp');
        }
        
        return $this->getModel()
                ->where('application', $appKey)
                ->first();
        
    }
    
}
