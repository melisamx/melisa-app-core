<?php

namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class RbacIdentitiesAbstract extends BaseUuid
{
    
    protected $table = 'rbacIdentities';
    public $timestamps = true;    
    protected $fillable = [
        'id',
        'idRbacRol',
        'idIdentity',
        'idIdentityCreated',
        'active',
        'createdAt',
        'isSytem',
        'idIdentityUpdated',
        'updatedAt',
    ];
    
}
