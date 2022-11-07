<?php

namespace VickyTsang\Divido\Exception;

class parseException extends \ErrorException{

	public function __construct(array $error){
        $message = 'Parsing error in file';
        $code = 0;
        $severity = 1;
        $filename = __FILE__;
        $lineno = __LINE__;
        $exception = null;

        parent::__construct($message, $code, $severity, $filename, $lineno, $exception);
    }
}
?>