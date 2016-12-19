<?php namespace App\Core\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class TranslationsRepository extends Repository
{
    
    public function model() {
        
        return 'App\Core\Models\Translations';
        
    }
    
}
