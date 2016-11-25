<?php namespace App\Core\Logics\Menus;

use Melisa\core\LogicBusiness;
use App\Core\Repositories\MenusOptionsRepository;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Hierarchical
{
    use LogicBusiness;
    
    protected $menus;

    public function __construct(MenusOptionsRepository $menus) {
        
        $this->menus = $menus;
        
    }
    
    public function generate($key) {
        
        $menu = $this->menus->getByMenuKey($key);
        
        if( !$menu) {
            
            return $menu;
            
        }
        
        $menuHierarchical = [];
        
        foreach($menu as $option) {
            
            if( $option->idOptionParent) {
                
                continue;
                
            }
            
            if( $option->optionKey === 'tbfill') {
                
                $menuHierarchical []= [
                    'type'=>'tbfill'
                ];
                continue;
                
            }
            
            $optionsChildren = $this->getOptionsChildren($menu, $option->id);
            
            $menuHierarchical [] = $this->buildSubMenu($optionsChildren, $option);
                        
        }
        
        return $menuHierarchical;
        
    }
    
    public function getOptionsChildren(&$menu, $idOptionParent) {
        
        $options = [];
        
        foreach($menu as $option) {
            
            if( $option->idOptionParent != $idOptionParent) {
                
                continue;
                
            }
            
            $subOptions = $this->getOptionsChildren($menu, $option->id);
            
            $options []= $this->buildSubMenu($subOptions, $option);
            
        }
        
        return $options;
        
    }
    
    public function buildSubMenu(&$subOptions, &$option) {
        
        $configOption = [
            'key'=>$option->optionKey,
            'text'=>$option->optionText,
            'name'=>$option->optionName,
            'icon'=>[
                'small'=>$option->optionIconClassSmall,
                'medium'=>$option->optionIconClassMedium,
                'large'=>$option->optionIconClassLarge,
            ],
        ];
        
        if( !empty($option->moduleNameSpace)) {
            
            $configOption ['nameSpace']= $option->moduleNameSpace;
            $configOption ['url']= $option->moduleUrl;
            $configOption ['active']= $option->moduleActive;
            $configOption ['version']= $option->moduleVersion;
            
        }
        
        $configOption ['items']= $subOptions;
        
        return $configOption;
        
    }
    
}
