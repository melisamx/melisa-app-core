<?php namespace App\Core\tests\Console\Commands;

 use App\Core\Console\Commands\ModelsGenerate;
 
/**
 * Description of ModelGenerateOverride
 *
 * @author Luis Josafat Heredia Contreras
 */
class ModelGenerateOverride extends ModelsGenerate
{
    
    protected function getDefaultNamespace($rootNamespace) {
        return $rootNamespace . '\ModelsTests';
    }
    
}
