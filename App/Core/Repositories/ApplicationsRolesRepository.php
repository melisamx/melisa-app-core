<?php namespace App\Core\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class ApplicationsRolesRepository extends Repository
{
    
    public function model() {
        
        return 'App\Core\Models\ApplicationsRoles';
        
    }
    
}
