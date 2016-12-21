<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ApplicationsRST extends BaseUuid
{
    
    protected $table = 'applicationsRST';
    
    protected $fillable = [
        'id', 'idApplicationRS', 'idTask', 'idIdentityCreated', 'active',
        'createdAt', 'updatedAt', 'idIdentityUpdated'
    ];
    
}
