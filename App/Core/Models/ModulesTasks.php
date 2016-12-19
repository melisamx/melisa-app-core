<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ModulesTasks extends Base
{
    
    protected $table = 'modulesTasks';
    
    protected $fillable = [
        'idModule', 'idTask'
    ];
    
    public $timestamps = false;
    
}
