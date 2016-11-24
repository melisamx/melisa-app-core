<?php namespace App\Core\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class MenusOptionsRepository extends Repository
{
    
    public function model() {
        
        return 'App\Core\Models\MenusOptions';
        
    }
    
    public function getByMenuKey($key) {
        
        return $this->model
            ->join('menus as m', 'm.id', '=', 'menusOptions.idMenu')
            ->leftJoin('options as o', 'o.id', '=', 'menusOptions.idOption')
            ->leftJoin('optionsTasks as ot', 'ot.idOption', '=', 'menusOptions.idOption')
            ->leftJoin('tasks as t', 't.id', '=', 'ot.idTask')
            ->leftJoin('modulesTasks as mt', 'mt.idTask', '=', 'ot.idTask')
            ->leftJoin('modules as mod', 'mod.id', '=', 'mt.idModule')
            ->where('m.key', $key)
            ->orderBy('menusOptions.idOptionParent')
            ->orderBy('menusOptions.order')
            ->get([
                'menusOptions.*',
                
                'o.name as optionName',
                'o.key as optionKey',
                'o.isSubMenu as optionIsSubMenu',
                
                't.id as taskId',
                't.key as taskKey',
                't.active as taskActive',
                't.pattern as taskPatern',
                
                'mod.active as moduleActive',
                'mod.url as moduleUrl',
                'mod.nameSpace as moduleNameSpace',
                'mod.version as moduleVersion',
            ]);
        
    }
    
}
