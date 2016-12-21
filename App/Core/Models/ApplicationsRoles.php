<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ApplicationsRoles extends BaseUuid
{
    
    protected $table = 'applicationsRoles';
    
    protected $fillable = [
        'id', 'idApplication', 'idIdentityCreated', 'rol', 'active', 'createdAt',
        'description', 'isSytem', 'updatedAt', 'idIdentityUpdated'
    ];
    
}
