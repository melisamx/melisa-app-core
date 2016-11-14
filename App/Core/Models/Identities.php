<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

class Identities extends BaseUuid
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idProfile', 'display', 'displayEspecific', 'active', 'isSystem',
        'idDefault',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
}
