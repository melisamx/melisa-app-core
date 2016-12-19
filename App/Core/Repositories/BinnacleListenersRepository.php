<?php namespace App\Core\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class BinnacleListenersRepository extends Repository
{
    
    const NEW_RECORD = 1;
    const PROCESSING = 2;
    const INDICTED = 3;
    const PROCESSED_WITH_ERRORS = 5;
    
    public function model() {
        
        return 'App\Core\Models\BinnacleListeners';
        
    }
    
    public function getStatus($key) {
        
        switch ($key) {
            case 'new':
                return self::NEW_RECORD;
            case 'processed':
                return self::INDICTED;
            case 'processedErrors':
                return self::PROCESSED_WITH_ERRORS;
            case 'processing':
                return self::PROCESSING;
        }
        
    }
        
}
