<?php namespace App\Core\Logics\Sencha;

use Illuminate\Filesystem\FileNotFoundException;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class File
{
    
    protected $viewNoFound = 'File no exist';

    public function render($path) {
        
        $debug = config('app.env') === 'local' ? true : false;
        
        /* remove extension */
        $pathView = 'sencha/' . str_replace('.js', '', str_replace('/', '/', $path));
        
        /* necesary laravel, by default extension blade.php and php */
        view()->addExtension('js', 'php');
                
        try {
            
            $view = view($pathView);
            
        } catch (FileNotFoundException $exception) {
            
            $view = $debug ? $this->viewNoFound : '';
            
        }
        
        return $view;
        
    }
    
}
