<?php namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class PackageAssetsSeeder extends InstallSeeder
{
    
    public function run()
    {
        
        $this->updateOrCreate('App\Core\Models\PackageAssets', [
            [
                'id'=>'sencha.app',
                'name'=>'Sencha Application',
            ],
        ]);
        
        $this->call(PackageAssetsItemsSeeder::class);
        
    }
    
}
