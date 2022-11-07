<?php

namespace VickyTsang\Divido\Test;

use VickyTsang\Divido\loadConfig;
use PHPUnit\Framework\TestCase;

class loadConfigTest extends TestCase{
    
	/**
     * test VickyTsang\Divido\loadConfig::__construct
	 * test unsupported file format
     */
    public function testUnsupportedFormatException(){
		$this->expectException(\VickyTsang\Divido\Exception\unsupportedFormatException::class);
		$this->expectExceptionMessage("Unsupported format");
		$config = new loadConfig(__DIR__ . '/../fixtures/config.txt');
    }
	
	/**
	 * test VickyTsang\Divido\loadConfig::__construct
	 * test file not found
	 */
	public function testNotFoundException(){
		$this->expectException(\VickyTsang\Divido\Exception\notFoundException::class);
		$this->expectExceptionMessage("File cannot be found");
		$config = new loadConfig(__DIR__ . '/../fixtures/notfound.json');
	}
	
	/**
	 * test VickyTsang\Divido\loadConfig::__construct, getValidPath
	 * test with single path
	 */
	public function testConstructSingleJson(){
		$loadConfig = new loadConfig(__DIR__ . '/../fixtures/config.json');
		$expected = 'production';
		$actual = $loadConfig->get("environment");
		$this->assertSame($expected, $actual);
	}
	
	/**
	 * test VickyTsang\Divido\loadConfig::__construct, getValidPath, getArrayPath
	 * test with array path
	 */
	public function testConstructArrayJson(){
		$loadConfig = new loadConfig([__DIR__ . '/../fixtures/config.json', __DIR__ . '/../fixtures/config.local.json']);
		$expected = 'development';
		$actual = $loadConfig->get("environment");
		$this->assertSame($expected, $actual);
	}
	
	/**
	 * test VickyTsang\Divido\loadConfig::__construct, getValidPath
	 * test with single path
	 */
	public function testConstructSingleIni(){
		$loadConfig = new loadConfig(__DIR__ . '/../fixtures/config.ini');
		$expected = 'production';
		$actual = $loadConfig->get("environment");
		$this->assertSame($expected, $actual);
	}
	
	/**
	 * test VickyTsang\Divido\loadConfig::__construct, getValidPath, getArrayPath
	 * test with array path
	 */
	public function testConstructArrayIni(){
		$loadConfig = new loadConfig([__DIR__ . '/../fixtures/config.ini', __DIR__ . '/../fixtures/config.local.ini']);
		$expected = 'development';
		$actual = $loadConfig->get("environment");
		$this->assertSame($expected, $actual);
	}
	
	/**
	 * test VickyTsang\Divido\loadConfig::__construct, getValidaPath, getArrayPath
	 * test array path with different format
	 */
	public function testConstructArrayMulti(){
		$loadConfig = new loadConfig([__DIR__ . '/../fixtures/config.ini', __DIR__ . '/../fixtures/config.local.json']);
		$expected = 'development';
		$actual = $loadConfig->get("environment");
		$this->assertSame($expected, $actual);
	}
	
}