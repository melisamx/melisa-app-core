<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Melisa\Laravel\Database\IdSeeder;
use App\Core\Models\User;

class UsersSeeder extends Seeder
{    
    use IdSeeder;
    
    public function run()
    {
                
        User::firstOrCreate([
            'id'=>$this->getId()
        ], [
            'name'=>'developer',
            'password'=>bcrypt('Dlemdo30$'),
            'email'=>'developer@melisa.mx',
            'isGod'=>true
        ]);
        
    }
    
}
