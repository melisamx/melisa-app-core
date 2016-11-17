<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

class Assets extends BaseUuid
{
    
    protected $fillable = [
        'idAssetType', 'name', 'key', 'version', 'extraParams'
    ];
    
}
