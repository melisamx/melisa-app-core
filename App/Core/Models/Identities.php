<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

class Identities extends BaseUuid
{
    
    protected $fillable = [
        'idProfile', 'display', 'displayEspecific', 'active', 'isSystem',
        'idDefault',
    ];
    
}
