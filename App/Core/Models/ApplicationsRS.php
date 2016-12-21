<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ApplicationsRS extends BaseUuid
{
    
    protected $table = 'applicationsRS';
    
    protected $fillable = [
        'id', 'idApplicationRol', 'idIdentityCreated', 'idScope', 'isDefault',
        'createdAt', 'updatedAt', 'idIdentityUpdated'
    ];
    
}
