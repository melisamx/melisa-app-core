<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class Profiles extends Base
{
    
    protected $fillable = [
        'name', 'key', 'isSystem', 'active', 'icon'
    ];
    
}
