<?php

use Illuminate\Database\Seeder;
use Melisa\Laravel\Database\FirstOrCreate;

class AssetsSenchaSeeder extends Seeder
{
    
    use FirstOrCreate;
    
    public function run()
    {
        
        $this->firstOrCreate('App\Core\Models\Assets', [
            [
                'id'=>'extjs.601.js',
                'idAssetType'=>1,
                'name'=>'Sencha ExtJS 6 all',
                'path'=>'/vendor/sencha/601/ext-all.js',
            ],
            [
                'id'=>'extjs.601.debug.js',
                'idAssetType'=>1,
                'name'=>'Sencha ExtJS 6 all debug',
                'path'=>'/vendor/sencha/601/ext-all-debug.js',
            ],
            [
                'id'=>'extjs.601.modern.js',
                'idAssetType'=>1,
                'name'=>'Sencha ExtJS 6 all modern',
                'path'=>'/vendor/sencha/601/ext-modern-all.js',
                'extraParams'=>'androidAsset=inject',
            ],
            [
                'id'=>'extjs.601.modern.debug.js',
                'idAssetType'=>1,
                'name'=>'Sencha ExtJS 6 all modern debug',
                'path'=>'/vendor/sencha/601/ext-modern-all-debug.js',
                'extraParams'=>'androidAsset=inject',
            ],
            [
                'id'=>'extjs.601.locale.es',
                'idAssetType'=>1,
                'name'=>'Sencha ExtJS 6 locale spanish',
                'path'=>'/vendor/sencha/601/classic/locale/locale-es.js',
            ],
            [
                'id'=>'extjs.601.modern.neptune',
                'idAssetType'=>1,
                'name'=>'Sencha ExtJS 6 theme modern neptune',
                'path'=>'/vendor/sencha/601/modern/theme-neptune/theme-neptune.js',
                'extraParams'=>'androidAsset=inject',
            ],
            [
                'id'=>'extjs.601.classic.triton',
                'idAssetType'=>1,
                'name'=>'Sencha ExtJS 6 theme classic triton',
                'path'=>'/vendor/sencha/601/classic/theme-triton/theme-triton.js',
            ],
            [
                'id'=>'extjs.601.charts',
                'idAssetType'=>1,
                'name'=>'Sencha ExtJS 6 charts',
                'path'=>'/vendor/sencha/601/packages/charts/classic/charts.js',
            ],
            [
                'id'=>'extjs.601.modern.neptune.css',
                'idAssetType'=>2,
                'name'=>'Sencha ExtJS 6 theme modern neptune',
                'path'=>'/vendor/sencha/601/modern/theme-neptune/resources/theme-neptune-all.css',
                'extraParams'=>'androidAsset=inject'
            ],
            [
                'id'=>'extjs.601.modern.triton.css',
                'idAssetType'=>2,
                'name'=>'Sencha ExtJS 6 theme classic triton',
                'path'=>'/vendor/sencha/601/classic/theme-triton/resources/theme-triton-all.css',
                'extraParams'=>'androidAsset=inject'
            ],
            [
                'id'=>'extjs.601.charts.css',
                'idAssetType'=>2,
                'name'=>'Sencha ExtJS 6 charts css',
                'path'=>'/vendor/sencha/601/packages/charts/classic/triton/resources/charts-all.css'
            ],
        ]);
        
    }
    
}
