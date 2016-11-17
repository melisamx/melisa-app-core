<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Melisa\Laravel\Database\IdSeeder;
use App\Core\Models\Profiles;

class ProfilesSeeder extends Seeder
{    
    use IdSeeder;
    
    public function run()
    {
                
        Profiles::firstOrCreate([
            'key'=>'system',
        ], [
            'name'=>'System',
            'isSystem'=>true,
            'icon'=>'fa fa-superpowers',
        ]);
        
    }
    
}
