<?php namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class AssetsCssSeeder extends InstallSeeder
{
    
    public function run()
    {
        
        $this->installAssetCss('fontawesome', [
            'name'=>'Fontawesome',
            'path'=>'/vendor/fontawesome/release/css/font-awesome.min.css',
            'cdn'=>'//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css',
            'extraParams'=>'androidAsset=inject',
            'version'=>'4.7.0',
        ]);
        
        $this->installAssetCss('animatecss', [
            'name'=>'Animate.css',
            'path'=>'/vendor/animatecss/release/animate.min.css',
            'extraParams'=>'androidAsset=inject',
        ]);
        
        $this->installAssetCss('waves.css', [
            'name'=>'Waves Css',
            'path'=>'/vendor/waves/release/waves.css',
            'extraParams'=>'androidAsset=inject',
        ]);
        
        $this->installAssetCss('waves.sencha', [
            'name'=>'Waves to Sencha',
            'path'=>'/vendor/waves/release/sencha.css',
            'extraParams'=>'androidAsset=inject',
        ]);
        
        $this->installAssetCss('roboto', [
            'name'=>'Font Roboto',
            'path'=>'/vendor/roboto/style.css',
            'extraParams'=>'androidAsset=inject',
        ]);
        
        $this->installAssetCss('bootstrap.reports', [
            'name'=>'Bootstrap for reports',
            'path'=>'/vendor/bootstrap/release/reports/css/bootstrap.min.css',
        ]);
        
        $this->installAssetCss('bootstrap.reports.print', [
            'name'=>'Bootstrap for reports and printers',
            'path'=>'/vendor/bootstrap/release/reports/css/print.css',
        ]);
        
    }
    
}
