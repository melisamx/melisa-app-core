<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class ModulesTasks extends Base
{
    
    protected $table = 'modulesTasks';
    
    protected $fillable = [
        'idModule', 'idTask'
    ];
    
    public $timestamps = false;
    
}
