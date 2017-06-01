<?php

namespace App\Core\Console;

use Illuminate\Support\Str;

/**
 * Description of GeneratorCommand
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class GeneratorCommand
{
    
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type;
    
    protected function create($file, $delete = false)
    {        
        $name = $this->parseName($file);
        
        $path = $this->getPath($name);
        
        if ($this->alreadyExists($file)) {
            
            if( !$delete) {
                $this->debug($file .' already exists!');
                return true;
            }
                
        }
        
        $this->makeDirectory($path);
        $this->files->put($path, $this->buildClass($name));
        
        $this->info($this->type.' created successfully.');
        return true;        
    }
    
    /**
     * Build update the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildUpdateClass($path, $name)
    {
        $stub = $this->files->get($path);
        return $this->replaceNamespace($stub, $name)
                ->replaceClass($stub, $name);
    }
    
    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        return $this->replaceNamespace($stub, $name)
                ->replaceClass($stub, $name);
    }
    
    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }
    
    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {        
        $name = str_replace(app()->getNamespace(), '', $name);        
        return base_path() . str_replace('\\', '/', $name).'.php';
    }
    
    /**
     * Get the full namespace name for a given class.
     *
     * @param  string  $name
     * @return string
     */
    protected function getNamespace($name)
    {
        return trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');
    }
    
    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);
        return str_replace('DummyClass', $class, $stub);
    }

    /**
     * Parse the name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function parseName($name)
    {        
        $rootNamespace = app()->getNamespace();
        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }
        if (Str::contains($name, '/')) {
            $name = str_replace('/', '\\', $name);
        }
        return $this->parseName($this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name);
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        $name = $this->parseName($rawName);
        return $this->files->exists($this->getPath($name));
    }
    
    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            'DummyNamespace', $this->getNamespace($name), $stub
        );
        $stub = str_replace(
            'DummyRootNamespace', app()->getNamespace(), $stub
        );
        return $this;
    }
    
}
