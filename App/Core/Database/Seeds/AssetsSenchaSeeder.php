<?php namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class AssetsSenchaSeeder extends InstallSeeder
{
    
    public function run()
    {
        
        $this->installAssetJs('extjs.601.js', [
            'name'=>'Sencha ExtJS 6 all',
            'path'=>'vendor/sencha/6.0.1/ext-all.js',
            'extraParams'=>'androidAsset=inject'                    
        ]);
        
        $this->installAssetJs('extjs.620.js', [
            'name'=>'Sencha ExtJS 6.2 all',
            'path'=>'vendor/sencha/6.2.0.981/ext-all.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.601.debug.js', [
            'name'=>'Sencha ExtJS 6 all debug',
            'path'=>'/vendor/sencha/6.0.1/ext-all-debug.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.620.debug.js', [
            'name'=>'Sencha ExtJS 6.2 all debug',
            'path'=>'/vendor/sencha/6.2.0.981/ext-all-debug.js',
            'extraParams'=>'androidAsset=inject',
        ]);
        
        $this->installAssetJs('extjs.601.modern.js', [
            'name'=>'Sencha ExtJS 6 all modern',
            'path'=>'/vendor/sencha/6.0.1/ext-modern-all.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.620.modern.js', [
            'name'=>'Sencha ExtJS 6.2 all modern',
            'path'=>'/vendor/sencha/6.2.0.981/ext-modern-all.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.601.modern.debug.js', [
            'name'=>'Sencha ExtJS 6 all modern debug',
            'path'=>'/vendor/sencha/6.0.1/ext-modern-all-debug.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.620.modern.debug.js', [
            'name'=>'Sencha ExtJS 6.2 all modern debug',
            'path'=>'/vendor/sencha/6.2.0.981/ext-modern-all-debug.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.601.locale.es', [
            'name'=>'Sencha ExtJS 6 locale spanish',
            'path'=>'/vendor/sencha/6.0.1/classic/locale/locale-es.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.620.locale.es', [
            'name'=>'Sencha ExtJS 6.2 locale spanish',
            'path'=>'/vendor/sencha/6.2.0.981/classic/locale/locale-es.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.601.modern.neptune', [
            'name'=>'Sencha ExtJS 6 theme modern neptune',
            'path'=>'/vendor/sencha/6.0.1/modern/theme-neptune/theme-neptune.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.620.modern.neptune', [
            'name'=>'Sencha ExtJS 6.2 theme modern neptune',
            'path'=>'/vendor/sencha/6.2.0.981/modern/theme-neptune/theme-neptune.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.620.modern.material', [
            'name'=>'Sencha ExtJS 6.2 theme modern material',
            'path'=>'/vendor/sencha/6.2.0.981/modern/theme-material/theme-material.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.601.classic.triton', [
            'name'=>'Sencha ExtJS 6 theme classic triton',
            'path'=>'/vendor/sencha/6.0.1/classic/theme-triton/theme-triton.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.620.classic.triton', [
            'name'=>'Sencha ExtJS 6.2 theme classic triton',
            'path'=>'/vendor/sencha/6.2.0.981/classic/theme-triton/theme-triton.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.601.charts', [
            'name'=>'Sencha ExtJS 6 charts',
            'path'=>'/vendor/sencha/6.0.1/packages/charts/classic/charts.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.620.charts', [
            'name'=>'Sencha ExtJS 6.2 charts',
            'path'=>'/vendor/sencha/6.2.0.981/packages/charts/classic/charts.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetCss('extjs.601.modern.neptune.css', [
            'name'=>'Sencha ExtJS 6 theme modern neptune css',
            'path'=>'/vendor/sencha/6.0.1/modern/theme-neptune/resources/theme-neptune-all.css',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetCss('extjs.620.modern.neptune.css', [
            'name'=>'Sencha ExtJS 6.2 theme modern neptune css',
            'path'=>'/vendor/sencha/6.2.0.981/modern/theme-neptune/resources/theme-neptune-all.css',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetCss('extjs.620.modern.material.css', [
            'name'=>'Sencha ExtJS 6.2 theme modern material css',
            'path'=>'/vendor/sencha/6.2.0.981/modern/theme-material/resources/theme-material-all.css',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetCss('extjs.601.classic.triton.css', [
            'name'=>'Sencha ExtJS 6 theme classic triton css',
            'path'=>'/vendor/sencha/6.0.1/classic/theme-triton/resources/theme-triton-all.css',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetCss('extjs.620.classic.triton.css', [
            'name'=>'Sencha ExtJS 6.2 theme classic triton css',
            'path'=>'/vendor/sencha/6.2.0.981/classic/theme-triton/resources/theme-triton-all.css',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetCss('extjs.601.charts.css', [
            'name'=>'Sencha ExtJS 6 charts css',
            'path'=>'/vendor/sencha/6.0.1/packages/charts/classic/triton/resources/charts-all.css',
            'extraParams'=>'androidAsset=inject',
        ]);
        
        $this->installAssetCss('extjs.620.charts.css', [
            'name'=>'Sencha ExtJS 6.2 charts css',
            'path'=>'/vendor/sencha/6.2.0.981/packages/charts/classic/triton/resources/charts-all.css',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.620.package.classic.triton', [
            'name'=>'Sencha ExtJS 6.2 package concat files theme triton',
            'path'=>'/vendor/sencha/6.2.0.981/sencha-classic-triton.min.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('extjs.620.package.modern.material', [
            'name'=>'Sencha ExtJS 6.2 package concat files theme material',
            'path'=>'/vendor/sencha/6.2.0.981/sencha-modern-material.min.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetCss('extjs.620.package.classic.triton.css', [
            'name'=>'Sencha ExtJS 6.2 all css',
            'path'=>'/vendor/sencha/6.2.0.981/sencha-classic-triton.css',
            'extraParams'=>'androidAsset=inject'
        ]);
        
    }
    
}
