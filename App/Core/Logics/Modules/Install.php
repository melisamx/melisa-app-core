<?php namespace App\Core\Logics\Modules;

use Melisa\core\LogicBusiness;
use App\Core\Repositories\ModulesRepository;
use App\Core\Repositories\TasksRepository;
use App\Core\Repositories\OptionsRepository;
use App\Core\Repositories\OptionsTasksRepository;
use App\Core\Repositories\MenusRepository;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Install
{
    use LogicBusiness;
    
    protected $modules;
    protected $tasks;
    protected $options;
    public $makes = [
        'menus'=>'App\Core\Logics\Menus\Install'
    ];

    public function __construct(
        ModulesRepository $modules,
        TasksRepository $tasks,
        OptionsRepository $options,
        OptionsTasksRepository $optionsTasks,
        MenusRepository $menus
    ) {
        
        $this->modules = $modules;
        $this->tasks = $tasks;
        $this->options = $options;
        $this->optionsTasks = $optionsTasks;
        $this->menus = $menus;
        
    }
    
    public function init($configsModules) {
        
        $this->modules->beginTransaction();
        $flag = true;
        
        foreach($configsModules as $configModule) {
            
            $configModule = melisa('array')->mergeDefault($configModule, [
                'menu'=>[]
            ]);
            
            $idModule = $this->createModule($configModule);
            
            if( !$idModule) {
                
                $flag = false;
                break;
                
            }
            
            $idTask = $this->createTask($configModule['url'], $configModule['task']);
            
            if( !$idTask) {
                
                $flag = false;
                break;
                
            }
            
            $idOption = $this->createOption($configModule['url'], $configModule['option']);
            
            if( !$idOption) {
                
                $flag = false;
                break;
                
            }
            
            $this->debug('Create or update task option {o} - {t}', [
                'o'=>$configModule['option']['name'],
                't'=>$configModule['task']['name']
            ]);
            
            $result = $this->createOptionTask($idOption, $idTask);
            
            if( !$result) {
                
                $flag = $this->error('Imposible create or update task option {o} - {t}', [
                    'o'=>$configModule['option']['name'],
                    't'=>$configModule['task']['name']
                ]);
                break;
                
            }
            
            $result = $this->createMenu($configModule['url'], $configModule['menu']);
            
            if( !$result) {
                
                $flag = false;
                break;
                
            }
            
        }
        
        if( !$flag) {
            
            return false;
            
        }
        
        $this->modules->commit();
        return true;
        
        
    }
    
    public function createMultiMenus($urlModule, &$config) {
        
        $flag = true;

        foreach($config as $menu) {
            
            $result = $this->createMenu($urlModule, $menu);

            if( $result) {

                continue;

            }

            $flag = false;
            break;


        }

        return $flag;
        
    }
    
    public function createMenu($urlModule, &$config) {
        
        /* optional define menu */
        if( empty($config)) {
            
            return true;
            
        }
        
        if( isset($config[0])) {
            
            return $this->createMultiMenus($urlModule, $config);
            
        }
        
        $keyMenu = isset($config['key']) ? $config['key'] : $urlModule;
        
        $menu = $this->menus->updateOrCreate([
            'key'=>$keyMenu,
        ], [
            'name'=>$config['name'],
        ]);
        
        if( !$menu) {
            
            return $this->error('Imposible create or update menu {n}', [
                'n'=>$keyMenu
            ]);
            
        }
        
        $buildMenu = [
            $keyMenu=>$config['options']
        ];
        
        return $this->make('menus')->init($buildMenu);
        
    }
    
    public function createModule(&$config) {
        
        $this->debug('Create or update module {m}', [
            'm'=>$config['name']
        ]);
        
        $module = $this->modules->updateOrCreate([
            'name'=>$config['name'],
            'url'=>$config['url'],
        ], [
            'description'=>$config['description'],
            'nameSpace'=>$config['nameSpace'],
            'version'=>isset($config['version']) ? 
                $config['version'] : '1.0.0',
            'iconClassSmall'=>isset($config['iconClassSmall']) ? 
                $config['iconClassSmall'] : 'fa fa-window-maximize fa-lg',
            'iconClassMedium'=>isset($config['iconClassMedium']) ? 
                $config['iconClassMedium'] : 'fa fa-window-maximize fa-3x',
            'iconClassLarge'=>isset($config['iconClassLarge']) ? 
                $config['iconClassLarge'] : 'fa fa-window-maximize fa-5x',
            'nameSpace'=>isset($config['nameSpace']) ? 
                $config['nameSpace'] : null,
        ]);
        
        if( !$module) {
            
            return $this->error('Imposible create or update module {n}', [
                'n'=>$config['name']
            ]);
            
        }
        
        return $module->id;
        
    }
    
    public function createOptionTask($idOption, $idTask) {
        
        $taskOption = $this->optionsTasks->updateOrCreate([
            'idOption'=>$idOption,
            'idTask'=>$idTask,
        ], []);
        
        if( !$taskOption) {
            
            return false;
            
        }
        
        return $taskOption->id;
        
    }
    
    public function createTask($urlModule, &$config) {
        
        $this->debug('Create or update task {m}', [
            'm'=>$config['name']
        ]);
        
        $keyTask = isset($config['key']) ? $config['key'] : $urlModule;
        $pattern = isset($config['pattern']) ? $config['pattern'] : 'create';
        $idPattern = $this->getPattern($pattern);
        
        $task = $this->tasks->updateOrCreate([
            'key'=>$keyTask,
        ], [
            'name'=>$config['name'],
            'active'=>isset($config['active']) ? 
                $config['active'] : true,
            'isSystem'=>isset($config['isSystem']) ? 
                $config['isSystem'] : false,
            'description'=>isset($config['description']) ? 
                $config['description'] : '',
            'pattern'=>$idPattern,
        ]);
        
        if( !$task) {
            
            return $this->error('Imposible create or update task {n}', [
                'n'=>$keyTask
            ]);
            
        }
        
        return $task->id;
        
    }
        
    public function createOption($urlModule, &$config) {
        
        $this->debug('Create or update option {o}', [
            'o'=>$config['name']
        ]);
        
        $keyOption = isset($config['key']) ? $config['key'] : $urlModule;
                
        $option = $this->options->updateOrCreate([
            'key'=>$keyOption,
        ], [
            'name'=>$config['name'],
            'text'=>$config['text'],
            'isSubMenu'=>isset($config['isSubMenu']) ? 
                $config['isSubMenu'] : false,
            'iconClassSmall'=>isset($config['iconClassSmall']) ? 
                $config['iconClassSmall'] : 'fa fa-cog fa-lg',
            'iconClassMedium'=>isset($config['iconClassMedium']) ? 
                $config['iconClassMedium'] : 'fa fa-cog fa-3x',
            'iconClassLarge'=>isset($config['iconClassLarge']) ? 
                $config['iconClassLarge'] : 'fa fa-cog fa-5x',
        ]);
        
        if( !$option) {
            
            return $this->error('Imposible create or update task {n}', [
                'n'=>$keyOption
            ]);
            
        }
        
        return $option->id;
        
    }
    
    public function getPattern($key) {
        
        return array_search($key, [
            'all',
            'all.crud',
            'all.create',
            'all.read',
            'all.update',
            'all.delete',
            'all.access',
            'access',
            'create',
            'read',
            'update',
            'delete',
            'select',
            'service',
            'library'
        ]);
        
    }
    
}