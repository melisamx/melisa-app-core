<?php namespace App\Core\Modules;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ManifestSenchaModule extends Outbuildings
{
    
    public $type = 'classic';
    public $js = [
        'classic'=>[
            'extjs.601.js',
            'extjs.601.classic.triton',
            'extjs.601.locale.es',
        ]
    ];
    public $css = [
        'classic'=>[
            'extjs.601.classic.triton.css'
        ]
    ];
    public $jsAdd = [];
    public $cssAdd = [];
    
    public function dataDictionary() {
        
        $configDefault = [
            'debug'=>$this->debug,
        ];
        
        $config = melisa('array')->mergeDefault($configDefault, $this->config());
        
        return [ 'melisa'=>$config ] + $this->manifest();
        
    }
    
    public function manifest() {
        
        return [
            'js'=>$this->getJs(),
            'css'=>$this->getCss(),
            'name'=>'Melisa',
            'version'=>'1.0.0.0',
            'id'=>'33333333-3333-3333-3333-333333333333',
            'cache'=>[
                'enable'=>$this->debug ? false : true,
                'deltas'=>'classic/deltas'
            ],
            'loader'=>[
                'cache'=>$this->debug ? false : true,
                'cacheParam'=>'_dc'
            ],
            'toolkit'=>'classic',
            'theme'=> 'theme-triton',
            'profile'=>'classic',
            'hash'=>'3333333333333333333333333333333333333333',
            'resources'=>[
                'path'=>'classic/resources',
                'shared'=>'app/resources'
            ],
            'fashion'=>[
                'inliner'=>[
                    'enable'=>true
                ]
            ],
            'autoPaths'=>true,
            'framework'=>'ext',
        ];
        
    }
    
    public function config() {
        
        return [];
        
    }
    
    public function getCss() {
        
        return $this->getAssets(array_merge($this->css[$this->type], $this->cssAdd));
        
    }
    
    public function getJs() {
        
        return $this->getAssets(array_merge($this->js[$this->type], $this->jsAdd));
        
    }
    
    public function getAssets($scripts) {        
        
        $assets = [];
        
        foreach($scripts as $js) {
            
            $asset = $this->asset($js);
            
            if( !$asset) {
                
                continue;
                
            }
            
            $assets []= $asset;
            
        }
        
        return $assets;
        
    }
    
}
