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
                'path'=>'/vendor/fontawesome/4.6.3/css/font-awesome.min.css',
                'cdn'=>'//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css',
                'extraParams'=>'androidAsset=inject',
            ],
            [
                'id'=>'animatecss',
                'idAssetType'=>2,
                'name'=>'Animate.css',
                'path'=>'/vendor/animatecss/3.5.1/animate.min.css',
                'extraParams'=>'androidAsset=inject',
            ],
            [
                'id'=>'waves.css',
                'idAssetType'=>2,
                'name'=>'Waves Css',
                'path'=>'/vendor/waves/0.7.5/waves.css',
                'extraParams'=>'androidAsset=inject',
            ],
            [
                'id'=>'waves.sencha',
                'idAssetType'=>2,
                'name'=>'Waves to Sencha',
                'path'=>'/vendor/waves/0.7.5/sencha.css',
                'extraParams'=>'androidAsset=inject',
            ],
            
        ]);
        
    }
    
}
