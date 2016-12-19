<?php namespace App\Core\Logics\Modules;

use Melisa\core\LogicBusiness;
use App\Core\Repositories\ModulesRepository;
use App\Core\Repositories\ModulesTasksRepository;
use App\Core\Repositories\TasksRepository;
use App\Core\Repositories\OptionsRepository;
use App\Core\Repositories\OptionsTasksRepository;
use App\Core\Repositories\MenusRepository;
use App\Core\Repositories\EventsRepository;
use App\Core\Repositories\ListenersRepository;
use App\Core\Logics\Menus\Install as MenusInstall;

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
    protected $optionsTasks;
    protected $modulesTasks;
    protected $menus;
    protected $menusInstall;
    protected $events;
    protected $listeners;

    public function __construct(
        ModulesRepository $modules,
        TasksRepository $tasks,
        OptionsRepository $options,
        OptionsTasksRepository $optionsTasks,
        MenusRepository $menus,
        MenusInstall $menusInstall,
        ModulesTasksRepository $modulesTasks,
        EventsRepository $events,
        ListenersRepository $listeners
    ) {
        
        $this->modules = $modules;
        $this->tasks = $tasks;
        $this->options = $options;
        $this->optionsTasks = $optionsTasks;
        $this->menus = $menus;
        $this->menusInstall = $menusInstall;
        $this->modulesTasks = $modulesTasks;
        $this->events = $events;
        $this->listeners = $listeners;
        
    }
    
    public function init($configsModules) {
        
        $this->modules->beginTransaction();
        $flag = true;
        
        foreach($configsModules as $configModule) {
            
            $configModule = melisa('array')->mergeDefault($configModule, [
                'menu'=>[],
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
            
            $result = $this->createModuleTask($idModule, $idTask);
            
            if( !$result) {
                
                $flag = $this->error('Imposible create or update module task {m} - {t}', [
                    'm'=>$configModule['name'],
                    't'=>$configModule['task']['name']
                ]);
                break;
                
            }
            
            if ( isset($configModule['event'])) {
                
                $idEvent = $this->createEvent($configModule['event']);
                
            }
            
            if ( isset($configModule['listener'])) {
                
                $idListener = $this->createListener($idModule, $configModule['listener']);
                
            }
            
            $idOption = $this->createOption($configModule['url'], $configModule['option']);
            
            if( !$idOption) {
                
                $flag = false;
                break;
                
            }
            
            if( $idOption === true) {
                
                continue;
                
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
        
        return $this->menusInstall->init($buildMenu);
        
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
            'nameSpace'=>isset($config['nameSpace']) ? 
                $config['nameSpace'] : null,
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
    
    public function createListener($idModule, &$keyListener) {
        
        $this->debug('Create or update listener {l}', [
            'l'=>$keyListener
        ]);
        
        if( is_string($keyListener)) {
            
            $keyListener = [
                'event'=>$keyListener,
                'active'=>true,
            ];
            
        }
        
        $event = $this->events->findBy('key', $keyListener['event']);
        
        if( !$event) {
            
            return false;
            
        }
        
        if( is_null($event)) {
            
            $this->debug('No exist event {e} ignore install listener', [
                'e'=>$keyListener['event']
            ]);
            return true;
            
        }
        
        $listener = $this->listeners->updateOrCreate([
            'idEvent'=>$event->id,
            'idModule'=>$idModule,
        ], [
            'active'=>$keyListener['active']
        ]);
        
        if( !$listener) {
            
            return false;
            
        }
        
        return $listener->id;
        
    }
    
    public function createEvent(&$config) {
        
        $this->debug('Create or update event {e}', [
            'e'=>$config['key']
        ]);
        
        $record = $this->events->updateOrCreate([
            'key'=>$config['key'],
        ], [
            'description'=>$config['description'],
            'isSystem'=>isset($config['isSystem']) ? $config['isSystem'] : false,
        ]);
        
        if( !$record) {
            
            return false;
            
        }
        
        return $record->id;
        
    }
    
    public function createModuleTask($idModule, $idTask) {
        
        $record = $this->modulesTasks->updateOrCreate([
            'idModule'=>$idModule,
            'idTask'=>$idTask,
        ], []);
        
        if( !$record) {
            
            return false;
            
        }
        
        return $record->id;
        
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
        
        if( is_null($config)) {
            
            $this->debug('Option no defined');
            return true;
            
        }
        
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
