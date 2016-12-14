<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

class RedirectsProfiles extends BaseUuid
{
    
    protected $table = 'redirectsProfiles';

    protected $fillable = [
        'idRedirect', 'idIdentityCreated', 'idProfile', 'active', 'idIdentityUpdated', 
        'updatedAt'
    ];
    
}
