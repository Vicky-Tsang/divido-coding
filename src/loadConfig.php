<?php

namespace VickyTsang\Divido;

use VickyTsang\Divido\Parser\ParserInterface;
use VickyTsang\Divido\Exception\unsupportedFormatException;
use VickyTsang\Divido\Exception\notFoundException;

class loadConfig extends config{
    
	protected $AllParser = [
		'VickyTsang\Divido\Parser\parseJson',
	];
	
    /**
     * load a Config instance.
     * @param  string|array    $values Filenames or string with configuration
     * @param  ParserInterface $parser Configuration parser
     */
    public function __construct($filename, ParserInterface $parser = null){
        $paths = $this->getValidPath($filename);
        $this->data = [];
		
        foreach($paths as $path){
			if($parser === null){
				$fileinformation = pathinfo($path);
				$filename = explode('.', $fileinformation['basename']);
				$extension = array_pop($filename);
				
				// get parser by extension and load file
				$parser = $this->getParser($extension);
				$this->data = array_replace_recursive($this->data, $parser->parse($path));
				
				// clean parser
				$parser = null;
			}else{
				//load file from parser
				$this->data = array_replace_recursive($this->data, $parser->parse($path));
			}
        }
		
        parent::__construct($this->data);
    }

	/**
     * get correct parser by file extension
     * @param  string $extension
     * @return ParserInterface
     * @throws Exception, if is an unsupported format
     */
    protected function getParser($extension){
        foreach($this->AllParser as $parser){
            if($extension === $parser::getFormat()){
                return new $parser();
            }
        }

        // If none exist, then throw an exception
        throw new unsupportedFormatException('Unsupported format');
    }
	
    /**
     * get array of paths
     * @param  array $path
     * @return array
     * @throw Exception, if a file is not found at $path
     */
    protected function getArrayPath($path){
        $paths = [];

        foreach($path as $singlePath){
            try{
                // If it exists, add to paths
                // If it not, throws an exception
				$paths = array_merge($paths, $this->getValidPath($singlePath));
				continue;
            }catch(Exception $e){
                throw $e;
            }
        }

        return $paths;
    }

    /**
     * Checks $path if valid
     * @param  string|array $path
     * @return array
     * @throw Exception, if a file is not found at $path
     */
    protected function getValidPath($path){
        // if $path is array
        if(is_array($path)){
            return $this->getArrayPath($path);
        }

        // If $path is not a file, throw an exception
        if(!file_exists($path)){
            throw new notFoundException("File cannot be found");
        }

        return [$path];
    }
}