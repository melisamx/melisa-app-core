<?php namespace App\Core\Logics\Menus;

use Melisa\core\LogicBusiness;
use App\Core\Repositories\MenusOptionsRepository;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Sencha
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
        
        $menuSencha = [];
        
        foreach($menu as $option) {
            
            if( $option->idOptionParent) {
                
                continue;
                
            }
            
            if( $option->optionKey === 'tbfill') {
                
                $menuSencha []= [
                    'xtype'=>'tbfill'
                ];
                continue;
                
            }
            
            $optionsChildren = $this->getOptionsChildren($menu, $option->idOption);
            
            if( count($optionsChildren) == 0) {
                
                $menuSencha []= $this->buildSubMenuEmpty($option);
                continue;
                
            }
            
            $submenu = $this->buildSubMenu($optionsChildren, $option);
            
            $menuSencha []= $this->buildMenuMain($submenu, $option);
            
        }
        
        return $menuSencha;
        
    }
    
    public function buildMenuMain(&$submenu, &$option) {
        
        $textOption = $option->optionText == '' ? $option->optionName : $option->optionText;
            
        $objectSubMenu = new \stdClass();
        $objectSubMenu->xtype = 'menu';
        $objectSubMenu->items = $submenu;

        return [
            'xtype'=>'button',
            'text'=>$textOption,
            'menu'=>$objectSubMenu,
            'melisa'=>[
                'tooltip'=>$option->optionName,
                'icon'=>[
                    'small'=>$option->optionIconClassSmall,
                    'medium'=>$option->optionIconClassMedium,
                    'large'=>$option->optionIconClassLarge,
                ]
            ]
        ];
    }
    
    public function getOptionsChildren(&$menu, $idOptionParent) {
        
        $options = [];
        
        foreach($menu as $option) {
            
            if( $option->idOptionParent != $idOptionParent) {
                
                continue;
                
            }
            
            $subOptions = $this->getOptionsChildren($menu, $option->idOption);
            
            if( count($subOptions) == 0) {
                
                $options []= $this->buildSubMenuEmpty($option);
                continue;
                
            }
            
            $options []= $this->buildSubMenu($subOptions, $option);
            
        }
        
        return $options;
        
    }
    
    public function buildSubMenuEmpty(&$option) {
        
        if( $option->optionIsSubMenu) {
            
            return;
            
        }
        
        $configOption = [
            'tooltip'=>$option->optionName,
            'icon'=>[]
        ];
        
        if( !empty($option->optionIconClassSmall)) {
            
            $configOption ['icon']['small']= $option->optionIconClassSmall;
            
        }
        
        if( !empty($option->optionIconClassMedium)) {
            
            $configOption ['icon']['medium']= $option->optionIconClassMedium;
            
        }
        
        if( !empty($option->optionIconClassLarge)) {
            
            $configOption ['icon']['large']= $option->optionIconClassLarge;
            
        }
        
        if( count($configOption['icon']) == 0) {
            
            unset($configOption['icon']);
            
        }
        
        if( !empty($option->moduleNameSpace) && $option->moduleActive) {
            
            $configOption ['nameSpace']= $option->moduleNameSpace;
            $configOption ['url']= $option->moduleUrl;
            
        }
        
        $textOption = $option->optionText == '' ? 
                $option->optionName : $option->optionText;
        
        return [
            'xtype'=>'menuitem',
            'itemId'=>$option->optionKey,
            'text'=>$textOption,
            'melisa'=>$configOption
        ];
        
    }
    
    public function buildSubMenu(&$subOptions, &$option) {
        
        $subMenu = new \stdClass();
        $subMenu->xtype = 'menu';
        $subMenu->items = $subOptions;
        
        $textOption = $option->optionText == '' ? $option->optionName : $option->optionText;
        
        return [
            'xtype'=>'menuitem',
            'text'=>$textOption,
            'menu'=>$subMenu
        ];
        
    }
    
}
