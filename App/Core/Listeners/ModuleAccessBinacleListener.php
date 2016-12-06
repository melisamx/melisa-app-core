<?php namespace App\Core\Listeners;

use App\Core\Events\ModuleAccessEvent;
use App\Core\Logics\Binnacle\RegisterEvent;
use Melisa\Laravel\Contracts\EventBinnacle;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ModuleAccessBinacleListener
{
    
    protected $register;

    public function __construct(RegisterEvent $register)
    {
        
        $this->register = $register;
        
    }
    
    /**
     * Handle the event.
     *
     * @param  ModuleAccessEvent  $event
     * @return void
     */
    public function handle(EventBinnacle $event)
    {
        
        return $this->register->init($event);
        
    }
    
}
