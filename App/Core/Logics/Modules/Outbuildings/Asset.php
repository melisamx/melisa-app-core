<?php namespace App\Core\Logics\Modules\Outbuildings;

use Melisa\core\LogicBusiness;
use Melisa\Laravel\Database\FindApplication;
use App\Core\Repositories\AssetsRepository;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Asset
{
    use LogicBusiness, FindApplication;
    
    public function __construct(AssetsRepository $assets) {
        
        $this->assetsrepository = $assets;
        $this->application = $this->findApplication(config('app.keyapp'));
        $this->nocache = config('app.env') === 'local' ? time() : '';
        $this->urlServer = config('app.url');
        
    }
    
    public function get($keys = []) {
        
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
        
        return count($assets) === 1 ? reset($assets)['url'] : $assets;
        
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

        $urlServer = $this->urlServer . $asset->path; 

        if (strpos($urlServer, '?')) {

            $urlServer .= '&' . $queryString;

        } else {

            $urlServer .= '?' . $queryString;

        }
        
        $loades [$key]= $asset->getAttributes() + [
            'url'=>$urlServer
        ];

        return $loades [$key];
        
    }
    
}
