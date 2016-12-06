<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
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
