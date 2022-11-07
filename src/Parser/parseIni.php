<?php

namespace VickyTsang\Divido\Parser;

use VickyTsang\Divido\Exception\parseException;

class parseIni implements ParserInterface{
	
	/**
	 * parse ini into array
	 * throw parseException if there is error
     * @param  string $filename
     * @return array
	 */
	public function parse($filename){
		error_clear_last();
		
		$data = @parse_ini_file($filename, true);
		
		if(is_array(error_get_last())){
            $error = error_get_last();
            throw new ParseException($error);
        }

        return $data;
	}
	
	/**
     * return the format of this parser
     * @return string
     */
    public static function getFormat(){
		return 'ini';
	}
}
?>