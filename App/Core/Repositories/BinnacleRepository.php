<?php namespace App\Core\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class BinnacleRepository extends Repository
{
    
    const NEW_RECORD = 1;
    const PROCESSING = 2;
    const INDICTED = 3;
    
    public function model() {
        
        return 'App\Core\Models\Binnacle';
        
    }
        
}
