<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class PackageAssetsItems extends Base
{
    
    protected $table = 'packageAssetsItems';
    
    public $timestamps = false;
    
    protected $fillable = [
        'idPackageAsset', 'idAsset'
    ];
    
}
