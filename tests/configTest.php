<?php

namespace VickyTsang\Divido\Test;

use VickyTsang\Divido\config;
use PHPUnit\Framework\TestCase;

class configTest extends TestCase{
    
	protected $config;
	
	protected $otherConfig;
	
	/**
	 * setup default config test value
	 */
	protected function setUp():void{
		$this->config = new config([
			"enviornment" => "production",
			"database" => [
				"host" => "mysql",
				"port" => 3306,
				"username" => "divido",
				"password" => "divido",
			],
			"cache" => [
				"redis" => [
					"host" => "redis",
					"port" => 6379,
				]
			]
		]);
		$this->otherConfig = new config([
			"enviornment" => "development",
			"database" => [
				"host" => "127.0.0.1",
				"port" => 3306,
				"username" => "divido",
				"password" => "divido",
			],
			"cache" => [
				"redis" => [
					"host" => "127.0.0.1",
					"port" => 6379,
				]
			]
		]);
	}
	
	/**
     * test VickyTsang\Divido\config::get
	 * test for string return
     */
    public function testGetString(){
		$expected = "production";
		$actual = $this->config->get("enviornment");
		$this->assertSame($expected, $actual);
    }
	
	/**
	 * test VickyTsang\Divido\config::get
	 * test for array return
	 */
	public function testGetArray(){
		$expected = [
			"redis" => [
				"host" => "redis",
				"port" => 6379,
			]
		];
		$actual = $this->config->get("cache");
		$this->assertSame($expected, $actual);
	}
	
	/**
	 * test VickyTsang\Divido\config::get
	 * test for nested key string return
	 */
	public function testGetNestedString(){
		$expected = "mysql";
		$actual = $this->config->get("database.host");
		$this->assertSame($expected, $actual);
	}
	
	/**
	 * test VickyTsang\Divido\config::get
	 * test for nested key array return
	 */
	public function testGetNestedArray(){
		$expected = [
			"host" => "redis",
			"port" => 6379,
		];
		$actual = $this->config->get("cache.redis");
		$this->assertSame($expected, $actual);
	}
	
	/**
	 * test VickyTsang\Divido\config::get
	 * test for not exist key
	 */
	public function testGetNotExist(){
		$this->assertNull($this->config->get("host"));
	}
	
	/**
	 * test VickyTsang\Divido\config::get
	 * test for not exist nested key
	 */
	public function testGetNestedNotExist(){
		$this->assertNull($this->config->get("cache.host"));
	}
	
	/**
	 * test VickyTsang\Divido\config::getAll
	 */
	public function testGetAll(){
		$expected = [
			"enviornment" => "production",
			"database" => [
				"host" => "mysql",
				"port" => 3306,
				"username" => "divido",
				"password" => "divido",
			],
			"cache" => [
				"redis" => [
					"host" => "redis",
					"port" => 6379,
				]
			]
		];
		$actual = $this->config->getAll();
		$this->assertSame($expected, $actual);
	}
	
	/**
	 * test VickyTsang\Divido\config::merge
	 * test merge and return string
	 */
	public function testMergeString(){
		$this->config->merge($this->otherConfig);
		$expected = "development";
		$actual = $this->config->get("enviornment");
		$this->assertSame($expected, $actual);
	}
	
	/**
	 * test VickyTsang\Divido\config::merge
	 * test merge and return array
	 */
	public function testMergeArray(){
		$this->config->merge($this->otherConfig);
		$expected = [
			"redis" => [
				"host" => "127.0.0.1",
				"port" => 6379,
			]
		];
		$actual = $this->config->get("cache");
		$this->assertSame($expected, $actual);
	}
	
}