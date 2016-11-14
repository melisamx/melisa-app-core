<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

class Profiles extends BaseUuid
{
    
    protected $fillable = [
        'name', 'key', 'isSystem', 'active', 'icon'
    ];
    
}
