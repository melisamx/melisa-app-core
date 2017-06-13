<?php

namespace App\Core\Database\Seeds;

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
        $this->installUser('developer', env('USER_DEVELOPER_PASSWORD', 'developer'), [
            'email'=>'developer@melisa.mx',
            'isGod'=>true,
            'active'=>true,
            'isSystem'=>true,
        ]);
                
        $this->installUser('demo', env('USER_DEMO_PASSWORD', 'demo'), [
            'email'=>'demo@melisa.mx',
            'active'=>true,
            'isSystem'=>true,
        ]);        
    }
    
}
