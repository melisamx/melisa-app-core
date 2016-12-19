<?php namespace App\Core\Logics\Redirects;

use Melisa\core\LogicBusiness;
use App\Core\Repositories\RedirectsRepository;

/**
 * Redirect logic
 *
 * @author Luis Josafat Heredia Contreras
 */
class Redirects
{
    
    use LogicBusiness;
    
    protected $redirects;
    public $makes = [
        'identities'=>'App\Core\Repositories\IdentitiesRepository',
        'identitySession'=>'App\Core\Logics\Identities\IdentitySession',
        'redirectsIdentities'=>'App\Core\Repositories\RedirectsIdentitiesRepository',
        'redirectsProfiles'=>'App\Core\Repositories\RedirectsProfilesRepository',
    ];

    public function __construct(RedirectsRepository $redirects) {
        
        $this->redirects = $redirects;
        
    }
    
    public function init($idUser = null) {
        
        $this->debug('Init logic redirect');
        
        if( !$redirects = $this->getRedirectsActives()) {
            
            return true;
            
        }
                
        if( !$identity = $this->getIdentity($idUser)) {
            
            return false;
            
        }
        
        return $this->processRedirects($identity, $redirects);
        
    }
    
    public function getIdentity($idUser) {
        
        $idIdentity = $this->make('identitySession')->init($idUser);
        
        if( !$idIdentity) {
            
            return false;
            
        }
        
        $identity = $this->make('identities')->find($idIdentity);
        
        if( !$idIdentity) {
            
            return $this->error('Imposible get identity data');
            
        }
        
        return $identity;
        
    }
    
    public function processRedirects(&$identity, &$redirects) {
        
        $flag = true;
        $responseRedirect = null;
                
        foreach($redirects as $redirect) {
            
            if( !$responseRedirect = $this->getRedirectIdentity($redirect->id, $identity->id)) {
                
                $flag = false;
                break;
                
            }
            
            if( $responseRedirect !== true) {
                
                break;
                
            }
            
            if( !$responseRedirect = $this->getRedirectProfile($redirect, $identity->idProfile)) {
                
                $flag = false;
                break;
                
            }
            
            if( $responseRedirect !== true) {
                
                break;
                
            }
            
        }
        
        return $flag ? $responseRedirect : false;
        
    }
    
    public function getRedirectProfile(&$redirect, $idProfile) {
        
        $redirects = $this->make('redirectsProfiles')->findWhere([
            'idRedirect'=>$redirect->id,
            'idProfile'=>$idProfile,
            'active'=>true
        ]);
        
        if( !$redirects->count()) {
            
            return true;
            
        }
        
        $redirecProfile = $redirects->first();
        
        return $this->isValidRedirect($redirecProfile, $redirect);
        
    }
    
    public function isValidRedirect(&$redirectAction, &$redirect) {
        
        if( $redirectAction === false) {
                
            return false;

        }

        if( $redirectAction === true) {

            return true;

        }
        
        if( !$application = $redirect->application) {
            
            return false;
            
        }
        
        return $this->getRedirectResponse($application->key, $redirect->path);
        
    }
    
    public function getRedirectIdentity($idRedirect, $idIdentity) {
        
        $redirectAction = $this->make('redirectsIdentities')->findWhere([
            'idRedirect'=>$idRedirect,
            'idIdentityRedirect'=>$idIdentity,
            'active'=>true
        ]);
        
        if( !$redirectAction->count()) {

            return true;

        }
        
        exit(var_dump('redirect identity'));
        
    }
    
    public function getRedirectsActives() {
        
        $redirects = $this->redirects->findWhere([
            'active'=>true
        ], ['id', 'idApplication', 'path']);
        
        if( !$redirects->count()) {
            
            $this->info('No redirects rules actives');
            return false;
            
        }
        
        return $redirects;
        
    }
    
    public function getRedirectResponse($frontController, $path = '') {
        
        $baseUrl = basename(request()->getBaseUrl());
        
        if( $frontController === str_replace('.php', '', $baseUrl)) {
            
            $this->info('Not necesary redirect');
            return true;
            
        }
        
        return redirect("../$frontController.php/" . ($path ? $path : ''));
        
    }
    
}
