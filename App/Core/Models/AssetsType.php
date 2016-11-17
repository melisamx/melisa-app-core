<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

class AssetsType extends BaseUuid
{
    
    protected $table = 'assetsTypes';
    
    protected $fillable = [
        'id', 'name', 'key'
    ];
    
}
