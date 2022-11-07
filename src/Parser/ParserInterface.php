<?php

namespace VickyTsang\Divido\Parser;

interface ParserInterface{

    /**
     * parse configuration from file and return array
     * @param  string $filename
     * @return array
     */
    public function parse($filename);

    /**
     * return the format of this parser
     * @return string
     */
    public static function getFormat();
	
}