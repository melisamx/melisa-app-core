<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PackageAssets extends BaseUuid
{
    
    protected $table = 'packageAssets';
    
    protected $fillable = [
        'id', 'name', 'version', 'extraParams'
    ];
    
    public function items() {
        
        return $this->hasMany('App\Core\Models\PackageAssetsItems', 'idPackageAsset', 'id');
        
    }
    
}
