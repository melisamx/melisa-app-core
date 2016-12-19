<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class RedirectsIdentities extends BaseUuid
{
    
    protected $table = 'redirectsIdentities';
    
    protected $fillable = [
        'idRedirect', 'idIdentityCreated', 'idIdentityRedirect', 'active', 
        'idIdentityUpdated', 'updatedAt'
    ];
    
}
