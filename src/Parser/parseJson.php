<?php

namespace VickyTsang\Divido\Parser;

use VickyTsang\Divido\Exception\parseException;

class parseJson implements ParserInterface{
	
	/**
	 * parse json into array
	 * throw parseException if there is error
     * @param  string $filename
     * @return array
	 */
	public function parse($filename){
		$data = json_decode(file_get_contents($filename), true);
		
		if(json_last_error() !== JSON_ERROR_NONE){
            $error = [
                'message' => json_last_error_msg(),
                'type'    => json_last_error(),
                'file'    => $filename,
            ];
            throw new ParseException($error);
        }

        return $data;
	}
	
	/**
     * return the format of this parser
     * @return string
     */
    public static function getFormat(){
		return 'json';
	}
}
?>