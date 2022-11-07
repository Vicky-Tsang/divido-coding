<?php

namespace VickyTsang\Divido;

class config{
    /**
     * store the configuration
     * @var array|null
     */
    protected $data = null;

    /**
     * Constructor method and sets default options, if any
     * @param array $data
     */
    public function __construct(array $data){
        $this->data = $data;
    }

    /**
     * get the configuration using key
	 * dot notation
     */
    public function get($key){
        $segments = explode('.', $key);
        $config = $this->data;

        // nested case
        foreach($segments as $segment){
            if (array_key_exists($segment, $config)) {
                $config = $config[$segment];
                continue;
            }else{
                return null;
            }
        }

        return $config;
    }

	/**
	 * get all configuration
	 */
	public function getAll(){
		return $this->data;
	}
	
    /**
     * Merge config from another instance
     *
     * @param config $config
     * @return config
     */
    public function merge(config $config){
        $this->data = array_replace_recursive($this->data, $config->getAll());
        return $this;
    }
}
?>