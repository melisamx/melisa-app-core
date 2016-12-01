<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Melisa\Laravel\Database\FirstOrCreate;

class AssetsCssSeeder extends Seeder
{
    
    use FirstOrCreate;
    
    public function run()
    {
        
        $this->firstOrCreate('App\Core\Models\Assets', [
            [
                'id'=>'fontawesome',
                'idAssetType'=>2,
                'name'=>'Fontawesome',
                'path'=>'/vendor/fontawesome/release/css/font-awesome.min.css',
                'cdn'=>'//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css',
                'extraParams'=>'androidAsset=inject',
            ],
            [
                'id'=>'animatecss',
                'idAssetType'=>2,
                'name'=>'Animate.css',
                'path'=>'/vendor/animatecss/release/animate.min.css',
                'extraParams'=>'androidAsset=inject',
            ],
            [
                'id'=>'waves.css',
                'idAssetType'=>2,
                'name'=>'Waves Css',
                'path'=>'/vendor/waves/release/waves.css',
                'extraParams'=>'androidAsset=inject',
            ],
            [
                'id'=>'waves.sencha',
                'idAssetType'=>2,
                'name'=>'Waves to Sencha',
                'path'=>'/vendor/waves/release/sencha.css',
                'extraParams'=>'androidAsset=inject',
            ],
            [
                'id'=>'roboto',
                'idAssetType'=>2,
                'name'=>'Font Roboto',
                'path'=>'/vendor/roboto/style.css',
                'extraParams'=>'androidAsset=inject',
            ],
            [
                'id'=>'bootstrap.reports',
                'idAssetType'=>2,
                'name'=>'Bootstrap for reports',
                'path'=>'/vendor/bootstrap/release/reports/css/bootstrap.min.css',
            ],
            [
                'id'=>'bootstrap.reports.print',
                'idAssetType'=>2,
                'name'=>'Bootstrap for reports and printers',
                'path'=>'/vendor/bootstrap/release/reports/css/print.css',
            ],
            
        ]);
        
    }
    
}
