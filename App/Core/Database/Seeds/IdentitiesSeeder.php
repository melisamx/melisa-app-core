<?php namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class IdentitiesSeeder extends InstallSeeder
{
    
    public function run()
    {
        
        $this->installIdentity('Developer', 'system', 'developer', [
            'display'=>'Developer',
            'active'=>true,
            'isDefault'=>true,
            'isSystem'=>true
        ]);
        
    }
    
}
