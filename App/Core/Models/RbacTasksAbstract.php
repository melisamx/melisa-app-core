<?php

namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class RbacTasksAbstract extends BaseUuid
{
    
    protected $table = 'rbacTasks';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'idRbacRol',
        'idTask',
        'idIdentityCreated',
        'active',
        'createdAt',
        'isSytem',
        'idIdentityUpdated',
        'updatedAt',
    ];
    
}
