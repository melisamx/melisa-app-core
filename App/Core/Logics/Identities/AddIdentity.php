<?php namespace App\Core\Logics\Identities;

use \App\Core\Repositories\IdentitiesRepository as Identities;
use \App\Core\Repositories\UsersIdentitiesRepository as UsersIdenties;
use \App\Core\Repositories\PeopleRepository as People;
use \App\Core\Repositories\ProfilesRepository as Profiles;
use \Melisa\core\LogicBusiness;

/**
 * Create identity to user
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddIdentity
{
    use LogicBusiness;
    
    protected $identities;
    protected $usersIdentities;
    protected $people;
    protected $profile;
    
    public function __construct(
            Identities $identities, 
            UsersIdenties $usersIdentities, 
            People $people,
            Profiles $profile
        ) {
        
        $this->identities = $identities;
        $this->usersIdentities = $usersIdentities;
        $this->people = $people;
        $this->profile = $profile;
        
    }
    
    /**
     * 
     * @param array $input
     * @return mixed Boolean | String Id Identity
     */
    public function init($idUser, array $input, $profileKey = 'personal', $createPerson = false) {
        
        $this->identities->beginTransaction();
        
        if( !$idProfile = $this->getProfile($profileKey)) {
            
            return false;
            
        }
        
        if( !$idIdentity = $this->createIdentity($idProfile, $input)) {
            
            return false;
            
        }       
        
        if( !$idUserIdentity = $this->createUserIdentity($idUser, $idIdentity)) {
            
            return false;
            
        }
        
        if( $createPerson && !$idPeople = $this->createPeople($input)) {
            
            return false;
            
        }
        
        if( $createPerson) {
            
            return [
                'idIdentity'=>$idIdentity,
                'idUserIdentity'=>$idUserIdentity,
                'idPeople'=>$idPeople,
            ];
            
        }
        
        return [
            'idIdentity'=>$idIdentity,
            'idUserIdentity'=>$idUserIdentity,
        ];
        
    }
    
    public function rollback() {
        
        $this->identities->rollback();
        
    }
    
    public function commit() {
        
        $this->identities->commit();
        
    }
    
    public function getProfile($key) {
        
        $profile = $this->profile->findBy('key', $key, ['id']);
        
        if( !$profile) {
            
            return $this->error('The profile type {k} no exist', [
                'k'=>$key
            ]);
            
        }
        
        return $profile->id;
        
    }
    
    public function createPeople(&$input) {
        
        $people = $this->people->create($input);
        
        if( !$people) {
            
            return $this->error('Imposible create personal data');
            
        }
        
        return $people;
        
    }
    
    public function createUserIdentity($idUser, $idIdentity) {
        
        $idUserIdentity = $this->usersIdentities->create([
            'idUser'=>$idUser,
            'idIdentity'=>$idIdentity
        ]);
        
        if( !$idUserIdentity) {
            
            return $this->error('Imposible create link user identity');
            
        }
        
        return $idUserIdentity;
        
    }
    
    public function createIdentity($idProfile, &$input) {
        
        $input ['idProfile']= $idProfile;
        $idIdentity = $this->identities->create($input);
        
        if( !$idIdentity) {
            
            return $this->error('Imposible create identity');
            
        }
        
        return $idIdentity;
        
    }
    
}
