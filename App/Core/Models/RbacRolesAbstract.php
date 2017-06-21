<?php

namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class RbacRolesAbstract extends BaseUuid
{
    
    protected $table = 'rbacRoles';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'idIdentityCreated',
        'role',
        'active',
        'createdAt',
        'description',
        'isSytem',
        'updatedAt',
        'idIdentityUpdated'
    ];
    
}
