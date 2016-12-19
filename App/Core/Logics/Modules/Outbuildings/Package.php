<?php namespace App\Core\Logics\Modules\Outbuildings;

use Melisa\core\LogicBusiness;
use App\Core\Repositories\PackageAssetsRepository;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Package
{
    use LogicBusiness;
    
    protected $outbuildings;
    protected $packageAssetsrepository;
    
    public function __construct(PackageAssetsRepository $packageAssets) {
        
        $this->packageAssetsrepository = $packageAssets;
        
    }
    
    public function setOutbuildings($outbuildings) {
        
        $this->outbuildings = $outbuildings;
        
    }
    
    public function get($keys = []) {
        
        if( is_string($keys)) {
            
            $keys =[ $keys ];
            
        }
        
        $this->debug('loading {c} packages: {i}', [
            'c'=>count($keys),
            'i'=>implode(',', $keys)
        ]);
        
        $packagesAssets = [];
        $flag = true;
        
        foreach($keys as $key) {
            
            $packageAsset = $this->load($key);
            exit(dd($packageAsset));
            if( !$packageAsset) {
                
                $flag = false;
                break;
                
            }
            
            $packagesAssets [$key]= $key;
            
        }
        
        return $flag ? $packagesAssets : false;
        
    }
    
    public function load($key) {
        
        $package = $this->packageAssetsrepository->find($key);
        
        $packageItems = $package->items;
        
        if( !count($packageItems)) {
            
            $this->debug('Package {p} empty', [
                'p'=>$key
            ]);
            return null;
            
        }
        
        $assets = [];
        
        foreach($packageItems as $packageItem) {
            
            $assets []= $packageItem->idAsset;
            
        }
        
        return $this->outbuildings->asset($assets);
        
    }
    
}
