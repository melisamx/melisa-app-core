<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

class Redirects extends BaseUuid
{
    
    protected $fillable = [
        'idApplication', 'idIdentityCreator', 'name', 'active', 'description',
        'path', 'idIdentityModification'
    ];
    
    public function application()
    {
        
        return $this->hasOne('App\Core\Models\Applications', 'id', 'idApplication');
        
    }
    
}
