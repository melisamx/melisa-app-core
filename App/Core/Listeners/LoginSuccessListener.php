<?php namespace App\Core\Listeners;

use Illuminate\Auth\Events\Login;
use App\Core\Logics\Binnacle\RegisterEvent;
use Melisa\Laravel\Contracts\EventBinnacle;
use App\Core\Logics\Identities\IdentitySession;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class LoginSuccessListener implements EventBinnacle
{
    
    protected $key = 'event.guest.user.login';
    protected $data = null;
    protected $register;
    protected $identity;

    public function __construct(RegisterEvent $register, IdentitySession $identity)
    {
        
        $this->register = $register;
        $this->identity = $identity;
                
    }
    
    public function getData() {
        
        return $this->data;
        
    }
    
    public function getKey() {
        
        return $this->key;
        
    }
    
    public function handle(Login $login)
    {
        
        $request = request();
        $this->data = [
            'idUser'=>$login->user->id,
            'idIdentity'=>$this->identity->init($login->user->id),
            'idDevice'=>$request->input('idDevice'),
            'idGoogleRegistration'=>$request->input('idGoogleRegistration'),
            'idOneSignalUser'=>$request->input('idOneSignalUser'),
            'remember'=>$login->remember
        ];
        
        return $this->register->init($this);
        
    }
    
}
