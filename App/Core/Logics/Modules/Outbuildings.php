<?php namespace App\Core\Logics\Modules;

use Melisa\core\LogicBusiness;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Outbuildings
{
    use LogicBusiness;
    
    public $debug = true;
    
    public function render() {
        
        $this->debug = config('app.env') === 'local' ? true : false;
        
        $dataDictionary = $this->dataDictionary($this);
        
        if( isset($this->layout) && is_string($this->layout)) {
            
            return view($this->layout, $dataDictionary);
            
        }
        
        return $dataDictionary;
        
    }
    
    public function dataDictionary() {
        
        
    }
            
    function __call($p, $arguments) {
        
        if( isset($this->{$p})) {
            
            return call_user_func_array([$this->{$p}, 'get'], $arguments);
            
        }
        
        try {
            
            $class = app()->make(__NAMESPACE__ . '\Outbuildings\\' . ucfirst($p));
            
        } catch (\ReflectionException $ex) {
            
            $class = $this->error('No support function: {m}', [
                'm'=>$ex->getMessage()
            ]);
            
        }
        
        if( !$class) {
            
            return null;
            
        }
        
        if(method_exists($class, 'setOutbuildings')) {
            
            $class->setOutbuildings($this);
            
        }        
        
        $this->{$p} = $class;
        
        return call_user_func_array([$this->{$p}, 'get'], $arguments);
        
    }
    
}
