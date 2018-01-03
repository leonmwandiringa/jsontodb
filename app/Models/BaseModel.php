<?php

/**
 * @uses manage dependencies from the container
 * @return void mixed container usage
 */

 namespace DealsWithGold\Models;
 
 class Model{

    protected $container;

        public function __construct($container){

            $this->container = $container;
        }

        public function __get($property){

            if($this->container->{$property}){
                return $this->$this->container->{$property};
            }
            
        }
 }

?>