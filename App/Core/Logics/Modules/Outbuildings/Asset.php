<?php namespace App\Core\Logics\Modules\Outbuildings;

use Melisa\core\LogicBusiness;
use App\Core\Repositories\AssetsRepository;
use App\Core\Repositories\ApplicationsRepository;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Asset
{
    use LogicBusiness;
    
    public function __construct(AssetsRepository $assets, ApplicationsRepository $application) {
        
        $this->assetsrepository = $assets;
        $this->application = $application->findBy('key', config('app.keyapp'));
        $this->nocache = config('app.env') === 'local' ? time() : '';
        $this->urlServer = config('app.url');
        
        if( !melisa('string')->endsWith($this->urlServer, '/')) {
            
            $this->urlServer .= '/';
            
        }
        
    }
    
    public function get($keys = [], $onlyUrl = false) {
        
        if( is_string($keys)) {
            
            $keys = [ $keys ];
            
        }
        
        $this->debug('loading {c} assets: {i}', [
            'c'=>count($keys),
            'i'=>implode(',', $keys)
        ]);
        
        $assets = [];
        $flag = true;
        
        foreach($keys as $key) {
            
            $asset = $this->load($key);
            
            if( $asset) {
                
                $assets [$key]= $asset;
                continue;
                
            }
            
            $flag = false;
            break;
            
        }
        
        if( !$flag) {
            
            return null;
            
        }
        
        if( count($keys) === 1) {
            
            return $onlyUrl ? reset($assets)['url'] : reset($assets);
            
        }
        
        return $onlyUrl ? array_column($assets, 'url') : $assets;
        
    }
    
    public function load($key, $data = []) {
        
        static $loades = [];
        
        if( isset($loades[$key])) {
            
            return $loades[$key];
            
        }
        
        $asset = $this->assetsrepository->find($key);
            
        if( !$asset) {

            $this->info('Imposible get asset {a}, using direct key', [
                'a'=>$key
            ]);
            
            /* suport assets statics definition */
            return [
                'url'=>$key
            ];

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
        
        
        
        /* request external */
        if( melisa('string')->startsWith($asset->path, '//')) {
            
            $urlServer = $asset->path;
            
        } else if( melisa('string')->startsWith($asset->path, '/')) {
            
            $urlServer = $this->urlServer .substr($asset->path, 1);
            
        }
        
        if (strpos($urlServer, '?')) {

            $urlServer .= '&' . $queryString;

        } else {

            $urlServer .= '?' . $queryString;

        }
        
        $loades [$key]= [
            'id'=>$asset->id,
            'idAssetType'=>$asset->idAssetType,
            'url'=>$urlServer
        ];

        return $loades [$key];
        
    }
    
}
