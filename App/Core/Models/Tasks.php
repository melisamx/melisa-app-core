<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class Tasks extends Base
{
    
    protected $table = 'tasks';
    
    protected $fillable = [
        'key', 'name', 'active', 'isSystem', 'description', 'pattern'
    ];
    
    public $timestamps = false;
    
}
