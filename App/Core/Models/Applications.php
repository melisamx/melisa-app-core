<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

class Applications extends BaseUuid
{
    
    protected $fillable = [
        'name', 'description', 'key', 'active', 'iconClassSmall', 'iconClassMedium',
        'iconClassLarge', 'nameSpace', 'typeSecurity', 'isSystem', 
        'updatedAt', 'version'
    ];
    
}
