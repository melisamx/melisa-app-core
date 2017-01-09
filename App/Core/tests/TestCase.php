<?php namespace App\Core\tests;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = '';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        
        $app = require __DIR__.'/../../../bootstrap/core.php';
        
        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        $this->baseUrl = env('APP_URL');
        
        return $app;
        
    }
    
}
