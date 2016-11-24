<?php namespace App\Core\Logics\Menus;

use App\Core\Repositories\MenusRepository;
use App\Core\Repositories\MenusOptionsRepository;
use App\Core\Repositories\OptionsRepository;
use Melisa\core\LogicBusiness;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Install
{
    use LogicBusiness;
    
    protected $menus;
    protected $options;
    protected $menusOptions;

    public function __construct(
            MenusRepository $menus, 
            OptionsRepository $options, 
            MenusOptionsRepository $menusOptions) {
        
        $this->menus = $menus;
        $this->options = $options;
        $this->menusOptions = $menusOptions;
        
    }
    
    public function init(array $menuConfig = []) {
        
        $flag = true;
        
        foreach($menuConfig as $menuKey => $options) {
                        
            $idMenu = $this->getId($menuKey);
            
            if( !$idMenu) {
                
                continue;
                
            }

            if( !$this->findOptions($idMenu, $options)) {
                
                $flag = false;
                break;
                
            }
            
        }
        
        return $flag;
        
    }
    
    public function findOptions($idMenu, $options) {
        
        $flag = true;
        
        $this->menusOptions->beginTransaction();
        
        foreach($options as $i => $optionKey) {
                
            $idOption = $this->getId($optionKey, 'options');

            if( !$idOption) {

                continue;

            }

            if( $this->createMenuOption($idMenu, $idOption, $i)) {
                
                continue;

            }
            
            $flag = false;
            break;

        }
        
        if( $flag) {
            
            $this->menusOptions->commit();
            
        } else {
            
            $this->menusOptions->rollBack();
                    
        }
        
        return $flag;
        
    }
    
    public function createMenuOption($idMenu, $idOption, $order = 0, $idOptionParent = null) {
        
        if( !$this->menusOptions->updateOrCreate([
            'idMenu'=>$idMenu,
            'idOption'=>$idOption,
        ], [
            'idOptionParent'=>$idOptionParent,
            'order'=>$order,
        ])) {
            
            return $this->error('Imposible create menu option');
            
        }
        
        return true;
        
    }
    
    public function getId($key, $repository = 'menus') {
        
        $object = $this->{$repository}->findBy('key', $key, [ 'id' ]);
        
        if( !$object) {
            
            return $this->error('No exist {r} {m}', [
                'r'=>$repository,
                'm'=>$key
            ]);
            
        }
        
        return $object->id;
        
    }
    
}
