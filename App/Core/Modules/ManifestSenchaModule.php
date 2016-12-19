<?php namespace App\Core\Modules;

use App\Core\Logics\Modules\Outbuildings;
use App\Core\Repositories\ApplicationsRepository;

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
            'debug'=>[
                'extjs.620.debug.js',
                'extjs.620.classic.triton',
                'extjs.620.locale.es',
            ],
            'nodebug'=>[
                'extjs.620.js',
                'extjs.620.classic.triton',
                'extjs.620.locale.es',
            ],
        ],
        'modern'=>[
            'debug'=>[
                'extjs.620.modern.debug.js',
                'extjs.620.modern.material',
                'extjs.620.locale.es',
            ],
            'nodebug'=>[
                'extjs.620.modern.js',
                'extjs.620.modern.material',
                'extjs.620.locale.es',
            ],
        ]
    ];
    public $css = [
        'classic'=>[
            'extjs.620.classic.triton.css'
        ],
        'modern'=>[
            'extjs.620.modern.material.css'
        ]
    ];
    public $jsAdd = [];
    public $cssAdd = [];
    public $pathsAdd = [];
    public $senchaPath = 'vendor/sencha/';
    public $senchaVersion = '6.2.0.981';
    public $senchaUxPath = '/src/ux';
    public $nsAdd = [];
    
    public function dataDictionary() {
        
        $configDefault = [
            'debug'=>$this->debug,
        ];
        
        $config = melisa('array')->mergeDefault($configDefault, $this->config());
        
        return [ 'melisa'=>$config ] + $this->manifest();
        
    }
    
    /**
     * Config basic in manifest sencha
     * @return Array
     */
    public function manifest() {
        
        return [
            'js'=>$this->getJs(),
            'css'=>$this->getCss(),
            'paths'=>$this->getPaths(),
            'name'=>'Melisa',
            'version'=>'1.0.0.0',
            'id'=>'33333333-3333-3333-3333-333333333333',
            'cache'=>[
                'enable'=>$this->debug ? false : false,
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
    
    /**
     * Add NameSpace from other apps
     * @return Array
     */
    public function getPaths() {
        
        $apps = app(ApplicationsRepository::class)->all([
            'nameSpace',
            'key',
            'version'
        ]);
        
        $urlServer = config('app.url');
        
        if( !melisa('string')->endsWith($urlServer, '/')) {
            
            $urlServer .= '/';
            
        }
        
        $nameSpaces = [
            'Ext.ux'=>$urlServer . $this->senchaPath . $this->senchaVersion .
                $this->senchaUxPath
        ];
        
        foreach($apps as $app) {
            
            $nameSpaces [$app->nameSpace]= sprintf('%s%s.php/sencha/%s', 
                $urlServer, 
                $app->key,
                $app->version
            );
            
        }
        
        return array_merge($nameSpaces, $this->nsAdd);
        
    }
    
    public function getCss() {
        
        $debug = $this->debug ? 'debug' : 'nodebug';
        
        return $this->getAssets(array_merge(
            isset($this->css[$this->type][$debug]) ? $this->css[$this->type][$debug] : $this->css[$this->type], 
            isset($this->cssAdd[$debug]) ? $this->cssAdd[$debug] : $this->cssAdd
        ));
        
    }
    
    public function getJs() {
        
        $debug = $this->debug ? 'debug' : 'nodebug';
        
        return $this->getAssets(array_merge(
            $this->js[$this->type][$debug], 
            isset($this->jsAdd[$debug]) ? $this->jsAdd[$debug] : $this->jsAdd
        ));
        
    }
    
    public function getAssets($scripts) {        
        
        $assets = [];
        
        foreach($scripts as $js) {
            
            $asset = $this->asset($js, true);
            
            if( !$asset) {
                
                continue;
                
            }
            
            $assets []= $asset;
            
        }
        
        return $assets;
        
    }
    
}
