<?php

namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class DatabaseSeeder extends InstallSeeder
{
    
    public function run()
    {               
        $this->call(ProfilesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(IdentitiesSeeder::class);
        $this->call(AssetsSeeder::class);
        $this->call(PackageAssetsSeeder::class);
        $this->call(TranslationsLanguagesSeeder::class);
        $this->call(BinnacleStatusSeeder::class);
        $this->call(BinnacleListenersStatusSeeder::class);        
    }
    
}
