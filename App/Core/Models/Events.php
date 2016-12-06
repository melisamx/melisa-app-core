<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

class Events extends BaseUuid
{
    
    protected $fillable = [
        'key', 'description', 'isSystem'
    ];
    
}
