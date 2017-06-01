<?php

namespace App\Core\Listeners;

use App\Core\Logics\Binnacle\RegisterEvent;
use Melisa\Laravel\Contracts\EventBinnacle;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class EventBinnacleListener
{
    
    protected $register;

    public function __construct(RegisterEvent $register)
    {        
        $this->register = $register;        
    }
    
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(EventBinnacle $event)
    {        
        return $this->register->init($event);        
    }
    
}
