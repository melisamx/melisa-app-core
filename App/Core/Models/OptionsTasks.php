<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class OptionsTasks extends Base
{
    
    protected $table = 'optionsTasks';
    
    protected $fillable = [
        'idOption', 'idTask'
    ];
    
    public $timestamps = false;
    
}
