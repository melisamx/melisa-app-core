<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

class Redirects extends BaseUuid
{
    
    protected $fillable = [
        'idApplication', 'idIdentityCreated', 'name', 'active', 'description',
        'path', 'idIdentityUpdated', 'updatedAt'
    ];
    
    public function application()
    {
        
        return $this->hasOne('App\Core\Models\Applications', 'id', 'idApplication');
        
    }
    
}
