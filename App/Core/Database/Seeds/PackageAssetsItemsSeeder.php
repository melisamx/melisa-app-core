<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Melisa\Laravel\Database\FirstOrCreate;

class PackageAssetsItemsSeeder extends Seeder
{
    
    use FirstOrCreate;
    
    public function run()
    {
        
        $this->firstOrCreate('App\Core\Models\PackageAssetsItems', [
            [
                'idPackageAsset'=>'sencha.app',
                'idAsset'=>'extjs.601.js',
            ],
            [
                'idPackageAsset'=>'sencha.app',
                'idAsset'=>'extjs.601.debug.js',
            ],
            [
                'idPackageAsset'=>'sencha.app',
                'idAsset'=>'extjs.601.locale.es',
            ],
            [
                'idPackageAsset'=>'sencha.app',
                'idAsset'=>'extjs.601.modern.js',
            ],
            [
                'idPackageAsset'=>'sencha.app',
                'idAsset'=>'extjs.601.modern.debug.js',
            ],
            [
                'idPackageAsset'=>'sencha.app',
                'idAsset'=>'extjs.601.modern.neptune',
            ],
            [
                'idPackageAsset'=>'sencha.app',
                'idAsset'=>'extjs.601.classic.triton',
            ],
            [
                'idPackageAsset'=>'sencha.app',
                'idAsset'=>'extjs.601.modern.triton.css',
            ],
            [
                'idPackageAsset'=>'sencha.app',
                'idAsset'=>'extjs.601.modern.neptune.css',
            ],
            [
                'idPackageAsset'=>'sencha.app',
                'idAsset'=>'extjs.601.charts',
            ],
            [
                'idPackageAsset'=>'sencha.app',
                'idAsset'=>'extjs.601.charts.css',
            ],
        ]);
        
    }
    
}
