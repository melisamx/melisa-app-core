<?php

namespace App\Core\Logics\Identities;

use App\Core\Repositories\UsersIdentitiesRepository;
use Melisa\core\LogicBusiness;

/**
 * Search identity default by id user
 *
 * @author Luis Josafat Heredia Contreras
 */
class SearchDefault
{
    use LogicBusiness;
    
    protected $repository;

    public function __construct(UsersIdentitiesRepository $usersIdentities)
    {        
        $this->repository = $usersIdentities;        
    }
    
    public function init($idUser)
    {        
        $usersIdentities = $this->repository->findAllBy('idUser', $idUser);
        
        if( !$usersIdentities->count()) {            
            return $this->error('Your user does not have assigned profiles');            
        }
        
        return $this->getDefault($usersIdentities);        
    }
    
    public function getDefault(&$usersIdentities)
    {        
        $identityDefault = false;
        
        foreach($usersIdentities as $userIdentity) {
            
            $identity = $userIdentity->identity;            
            if( !$identity) {                
                continue;                
            }
            
            if( !$identity->active) {                
                continue;                
            }
            
            if( !$identity->isDefault) {                
                continue;                
            }
            
            $identityDefault = $identity;            
        }
        
        if( !$identityDefault) {            
            return $this->error('Your user does not have a default identity');            
        }
        
        return $identityDefault;        
    }
    
}
