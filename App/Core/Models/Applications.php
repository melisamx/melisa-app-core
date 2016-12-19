<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Applications extends BaseUuid
{
    
    protected $fillable = [
        'name', 'description', 'key', 'active', 'iconClassSmall', 'iconClassMedium',
        'iconClassLarge', 'nameSpace', 'typeSecurity', 'isSystem', 
        'updatedAt', 'version'
    ];
    
}
