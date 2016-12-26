<?php namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class UsersSeeder extends InstallSeeder
{
    
    public function run()
    {
                
        $this->installUser('developer', 'Dlemdo30$', [
            'email'=>'developer@melisa.mx',
            'isGod'=>true
        ]);
                
        $this->installUser('demo', 'Godlemb03fmaj', [
            'email'=>'demo@melisa.mx',
        ]);
        
    }
    
}
