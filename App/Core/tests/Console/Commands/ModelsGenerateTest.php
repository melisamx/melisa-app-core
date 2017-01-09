<?php namespace App\Core\tests\Console\Commands;

use App\Core\tests\TestCase;
use Illuminate\Filesystem\Filesystem;

/**
 * Test models generate test
 *
 * @author Luis Josafat Heredia Contreras
 */
class ModelsGenerateTest extends TestCase
{
    
    public function setUp()
    {
        
        parent::setUp();
        
        $this->class = app()->make(ModelGenerateOverride::class);
        $this->file = app(Filesystem::class);
        $this->groupConnectionTest = 'mysql';
        $this->prefixTest = '';
        $this->pathTest = base_path() . '/ModelsTests/';
        $this->nameSpaceTest = app()->getNamespace() . '\\ModelsTests\\';
        $this->connection = $this->class->getConnection($this->groupConnectionTest);        
        
        $this->file->deleteDirectory($this->pathTest, true);
        
    }
    
    public function testConnection()
    {
        
        $this->assertEquals($this->groupConnectionTest, $this->connection->getConfig('name'));
        
    }
    
    public function testTables()
    {
        
        $tables = $this->class->getTables();
        $tablesInDatabase = $this->connection->select('show tables');
        $tablesGenerate = $this->class->getTablesGenerate();
        
        $this->assertEquals($this->prefixTest, $this->connection->getConfig('prefix'));
        $this->assertEquals(count($tables), count($tablesInDatabase));
        
    }
    
    public function testFieldMetadata()
    {
        
        $tables = $this->class->getTables();
        $fieldMetadataFirst = $this->class->getFieldMetadata($this->connection, $tables[0]);
        
        $this->assertEquals(true, is_array($fieldMetadataFirst));
        $this->assertEquals(false, empty($fieldMetadataFirst));
        
    }
    
    public function testFilesGenerate()
    {
        
        $tables = $this->class->getTables();
        
        $this->assertEquals(true, $this->class->init($this->groupConnectionTest));
        
        $this->existFiles($this->pathTest, $this->prefixTest, $tables);
        $this->isValidConnection($this->nameSpaceTest, $this->groupConnectionTest, $this->prefixTest, $tables);
                
    }
    
    public function isValidConnection($nameSpaceTest, $groupConnectionTest, $prefixTest, $tables)
    {
        
        foreach($tables as $table) {
            
            $table = $this->getWithPrefix($table, $prefixTest);
            
            $class = app($nameSpaceTest . ucfirst($table));
            
            $this->assertEquals($groupConnectionTest, $class->getConnectionName());
            
            if( empty($prefixTest)) {
                
                $this->assertEquals($table, $class->getTable());
                
            } else {
                
                $this->assertEquals($table, ucfirst($class->getTable()));
                
            }
            
        }
        
    }
    
    public function getWithPrefix($table, $prefixTest)
    {
        
        if( !empty($prefixTest) && substr($table, 0, strlen($prefixTest)) == $prefixTest) {
            
            return substr($table, strlen($prefixTest));

        }
        
        return $table;
        
    }
    
    public function existFiles($pathTest, $prefixTest, $tables)
    {
        
        foreach($tables as $table) {
            
            $table = $this->getWithPrefix($table, $prefixTest);
            
            $pathFile = $pathTest . ucfirst($table) . '.php';
            $this->assertEquals(true, $this->file->exists($pathFile));
            
        }
        
    }
    
}
