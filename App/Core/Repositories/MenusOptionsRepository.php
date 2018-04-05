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
    
    public function getByMenuKey($key, $language = 'es') {
                
        return $this->model
            ->join('menus as m', 'm.id', '=', 'menusOptions.idMenu')
            ->leftJoin('options as o', 'o.id', '=', 'menusOptions.idOption')
            ->leftJoin('optionsTasks as ot', 'ot.idOption', '=', 'menusOptions.idOption')
            ->leftJoin('tasks as t', 't.id', '=', 'ot.idTask')
            ->leftJoin('modulesTasks as mt', 'mt.idTask', '=', 'ot.idTask')
            ->leftJoin('modules as mod', 'mod.id', '=', 'mt.idModule')
            ->leftJoin('translations as tr', function($join) use ($language) {
                
                $join->on('tr.idTranslationLanguage', '=', \DB::raw("'". $language. "'"));
                $join->on('tr.key', '=', 'o.key');
                
            })
            ->where('m.key', $key)
            ->orderBy('menusOptions.idOptionParent')
            ->orderBy('menusOptions.order')
            ->get([
                'menusOptions.*',
                
                'o.name as optionName',
                'o.key as optionKey',
                'o.text as optionText',
                'o.isSubMenu as optionIsSubMenu',
                'o.iconClassSmall as optionIconClassSmall',
                'o.iconClassMedium as optionIconClassMedium',
                'o.iconClassLarge as optionIconClassLarge',
                
                'tr.text as optionTextTranslation',
                
                't.id as taskId',
                't.key as taskKey',
                't.active as taskActive',
                't.pattern as taskPatern',
                
                'mod.active as moduleActive',
                'mod.url as moduleUrl',
                'mod.route as moduleRoute',
                'mod.nameSpace as moduleNameSpace',
                'mod.version as moduleVersion',
            ]);
        
    }
    
}
