<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Assets extends BaseUuid
{
    
    protected $fillable = [
        'idAssetType', 'name', 'key', 'version', 'extraParams'
    ];
    
}
