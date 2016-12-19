<?php namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class PackageAssetsItemsSeeder extends InstallSeeder
{
    
    public function run()
    {
        
        $this->updateOrCreate('App\Core\Models\PackageAssetsItems', [
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
                'idAsset'=>'extjs.601.classic.triton.css',
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
