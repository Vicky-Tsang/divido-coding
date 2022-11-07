<?php

namespace VickyTsang\Divido\Test;

use VickyTsang\Divido\Parser\parseJson;
use PHPUnit\Framework\TestCase;

class parseJsonTest extends TestCase{
    
	protected $parseJson;
	
	protected function setUp():void{
		$this->parseJson = new parseJson();
	}
	
	/**
	 * test VickyTsang\Divido\Parser\parseJson::parseJson
	 */
	public function testParseJson(){
		$json = '{
			"environment": "production",
			"database": {
				"host": "mysql",
				"port": 3306,
				"username": "divido",
				"password": "divido"
			},
			"cache": {
				"redis": {
					"host": "redis",
					"port": 6379
				}
			}
		}';
		$expected = json_decode($json, true);
		$actual = $this->parseJson->parse(__DIR__.'/../fixtures/config.json');
        $this->assertSame($expected, $actual);
	}
	
	/**
	 * test VickyTsang\Divido\Parser\parseJson::parseJson
	 * test invalid json
	 */
	public function testInvalidJson(){
		$this->expectException(\VickyTsang\Divido\Exception\parseException::class);
		$this->expectExceptionMessage("Parsing error in file");
		$this->parseJson->parse(__DIR__.'/../fixtures/config.invalid.json');
	}
	
	/**
     * test VickyTsang\Divido\Parser\parseJson::getFormat
     */
    public function testGetFormat(){
        $expected = 'json';
        $actual = $this->parseJson->getFormat();
        $this->assertSame($expected, $actual);
    }
	
}