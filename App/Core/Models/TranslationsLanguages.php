<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class TranslationsLanguages extends Base
{
    
    protected $table = 'translationsLanguages';
    
    protected $fillable = [
        'id', 'name'
    ];
    
    public $timestamps = false;
    
}
