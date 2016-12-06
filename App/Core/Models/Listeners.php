<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

class Listeners extends BaseUuid
{
    
    protected $fillable = [
        'idEvent', 'idModule', 'idCreator', 'active'
    ];
    
}
