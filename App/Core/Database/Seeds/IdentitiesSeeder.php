<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Melisa\Laravel\Database\CreateIdentity;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class IdentitiesSeeder extends Seeder
{    
    use CreateIdentity;
    
    public function run()
    {
                
        $this->createIdentity();
        
    }
    
}
