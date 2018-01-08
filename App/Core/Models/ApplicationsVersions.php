<?php

namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ApplicationsVersions extends Base
{
    
    protected $table = 'applicationsVersions';
    
    protected $fillable = [
        'idApplication', 
        'version', 
        'comments'
    ];
    
}
