<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class OptionsTasks extends Base
{
    
    protected $table = 'optionsTasks';
    
    protected $fillable = [
        'idOption', 'idTask'
    ];
    
    public $timestamps = false;
    
}
