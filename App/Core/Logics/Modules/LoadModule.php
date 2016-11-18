<?php namespace App\Core\Logics\Modules;

use Melisa\core\LogicBusiness;
use Melisa\Laravel\Database\FindApplication;
use App\Core\Repositories\AssetsRepository;
use App\Core\Repositories\PackageAssetsRepository;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class LoadModule
{
    use LogicBusiness, FindApplication;
    
    public $makes = [
        'assets'=>'App\Core\Repositories\AssetsRepository',
    ];
    
    protected $config = [
        'assets'=>[],
        'packageAssets'=>[],
        'views'=>[],
        'menus'=>[],
        'modules'=>[],
        'files'=>[],
    ];
    protected $assetsrepository;
    protected $packageAssetsrepository;

    public $assets = [];
    public $views = [];
    public $packageAssets = [];
    
    public function __construct(AssetsRepository $assets, PackageAssetsRepository $packageAssets) {
        
        $this->assetsrepository = $assets;
        $this->packageAssetsrepository = $packageAssets;
        $this->application = $this->findApplication(config('app.keyapp'));
        $this->nocache = config('app.env') === 'local' ? time() : '';
        $this->urlServer = config('app.url');
        
    }
    
    public function init() {
        
        if( !empty($this->assets)) {
            
            $this->config ['assets']= $this->getAssets();
            
        }
        
        if( !empty($this->views)) {
            
            $this->config ['views']= $this->getViews();
            
        }
        
        if( !empty($this->packageAssets)) {
            
            $this->config ['packageAssets']= $this->getPackageAssets();
            
        }
        
        $dataDictionary = $this->dataDictionary($this->config);
        
        return view($this->layout, $dataDictionary);
        
    }
    
    public function getPackageAssets($key) {
        
        if( is_string($this->packageAssets)) {
            
            $this->packageAssets =[ $this->packageAssets ];
            
        }
        
        foreach($this->packageAssets as $packageAsset) {
            
            
        }
        
    }
    
    public function loadPackageAsset($key) {
        
        $package = $this->packageAssetsrepository->findWhere([
            'key'=>$key
        ]);
        
        exit(var_dump($package));
        
    }
    
    public function getViews() {
        
        if( is_string($this->views)) {
            
            $this->views = [ $this->views ];
            
        }
        
        $this->debug('loading {c} views: {i}', [
            'c'=>count($this->views),
            'i'=>implode(',', $this->views)
        ]);
        
        $views = [];
        $flag = true;
        
        foreach($this->views as $key) {
            
            $view = $this->loadView($key);
            
            if( !$view) {
                
                $flag = false;
                break;
                
            }
            
            $views [$key]= $view;
            
        }
        
        return $flag ? $views : false;
        
    }    
    
    public function getAsset($key, $field = 'url') {
        
        if( !isset($this->config['assets'][$key])) {
            
            $this->config['assets'][$key] = $this->loadAsset($key);
            
        }
        
        if( $field && isset($this->config['assets'][$key][$field])) {
            
            return $this->config['assets'][$key][$field];
            
        }
        
        return $this->config['assets'][$key];
        
    }
    
    public function getFile($key) {
        
        if( !isset($this->config['files'][$key])) {
            
            return null;
            
        }
        
        return $this->config['files'][$key];
        
    }
    
    public function getView($key, array $data = []) {
        
        if( !isset($this->config['views'][$key])) {
            
            $this->config ['views'][$key]= $this->loadView($key, $data);
            
        }
        
        return $this->config['views'][$key];
        
    }
    
    public function getAssets() {
        
        if( is_string($this->assets)) {
            
            $this->assets = [ $this->assets ];
            
        }
        
        $this->debug('loading {c} assets: {i}', [
            'c'=>count($this->assets),
            'i'=>implode(',', $this->assets)
        ]);
        
        $assets = [];
        $flag = true;
        
        foreach($this->assets as $key) {
            
            $asset = $this->loadAsset($key);
            
            if( $asset) {
                
                $assets [$key]= $asset;
                continue;
                
            }
            
            $flag = false;
            break;
            
        }
        
        if( !$flag) {
            
            return false;
            
        }
        
        return $assets;
        
    }
    
    public function loadAsset($key) {
        
        $asset = $this->assetsrepository->find($key);
            
        if( !$asset) {

            return $this->error('Imposible get asset {a}', [
                'a'=>$key
            ]);

        }

        $params = [
            'appVersion'=>$this->application->version,
            'version'=>$asset->version,
            'nocache'=>$this->nocache
        ];

        $queryString = http_build_query($params);

        if( !empty($asset->extraParams)) {

            $queryString .= '&' . $asset->extraParams;

        }

        $urlServer = $this->urlServer . $asset->path; 

        if (strpos($urlServer, '?')) {

            $urlServer .= '&' . $queryString;

        } else {

            $urlServer .= '?' . $queryString;

        }

        return $asset->getAttributes() + [
            'url'=>$urlServer
        ];
        
    }
    
    public function loadView($key, $data = []) {
        
        try {
                
            $view = \View::make($key, $data);

        } catch (Illuminate\Filesystem\FileNotFoundException $exception) {

            $view = $this->error('The view {k} no exist', [
                'v'=>$key
            ]);

        }
        
        return $view->render();
            
    }
    
}
