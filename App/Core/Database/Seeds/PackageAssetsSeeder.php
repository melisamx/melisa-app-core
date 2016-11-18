<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Melisa\Laravel\Database\FirstOrCreate;

class PackageAssetsSeeder extends Seeder
{
    
    use FirstOrCreate;
    
    public function run()
    {
        
        $this->firstOrCreate('App\Core\Models\PackageAssets', [
            [
                'id'=>'sencha.app',
                'name'=>'Sencha Application',
            ],
        ]);
        
        $this->call(PackageAssetsItemsSeeder::class);
        
    }
    
}
