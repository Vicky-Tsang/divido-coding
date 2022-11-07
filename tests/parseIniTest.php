<?php

namespace VickyTsang\Divido\Test;

use VickyTsang\Divido\Parser\parseIni;
use PHPUnit\Framework\TestCase;

class parseIniTest extends TestCase{
    
	protected $parseIni;
	
	protected function setUp():void{
		$this->parseIni = new parseIni();
	}
	
	/**
	 * test VickyTsang\Divido\Parser\parseIni::parseIni
	 */
	public function testParseIni(){
		$expected = @parse_ini_file(__DIR__.'/../fixtures/config.ini', true);
		$actual = $this->parseIni->parse(__DIR__.'/../fixtures/config.ini');
        $this->assertSame($expected, $actual);
    }
	
	/**
	 * test VickyTsang\Divido\Parser\parseIni::parseIni
	 * test invalid json
	 */
	public function testInvalidIni(){
		$this->expectException(\VickyTsang\Divido\Exception\parseException::class);
		$this->expectExceptionMessage("Parsing error in file");
		$this->parseIni->parse(__DIR__.'/../fixtures/config.invalid.ini');
	}
	
	/**
     * test VickyTsang\Divido\Parser\parseIni::getFormat
     */
    public function testGetFormat(){
        $expected = 'ini';
        $actual = $this->parseIni->getFormat();
        $this->assertSame($expected, $actual);
    }
	
}