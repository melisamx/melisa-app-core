<?php

namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Identities extends BaseUuid
{
    
    protected $fillable = [
        'idProfile',
        'display',
        'displayEspecific',
        'active',
        'isSystem',
        'isDefault',
    ];
    
}
