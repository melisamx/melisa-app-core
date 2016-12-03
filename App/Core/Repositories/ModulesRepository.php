<?php namespace App\Core\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class ModulesRepository extends Repository
{
    
    public function model() {
        
        return 'App\Core\Models\Modules';
        
    }
    
    public function getByKeyTask($key, $language = 'es') {
        
        return $this->model
            ->join('modulesTasks as mt', 'mt.idModule', '=', 'modules.id')
            ->join('tasks as t', 't.id', '=', 'mt.idTask')
            ->where('t.key', $key)
            ->limit(1)
            ->get([
                'modules.*',
                't.key as taskKey',
                't.active as taskActive',
            ])
            ->first();
        
    }
    
}
