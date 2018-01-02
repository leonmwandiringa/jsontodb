<?php
/**
 * @uses base controller for dependacny and resource management
 * @return void mixed container usage
 * 
 */

namespace DealsWithGold\Controllers;
use DealsWithGold\Helpers\LocalesHelper;

class Controller extends LocalesHelper{

    protected $container;

    public function __construct($container){

            $this->container = $container;

    }

    public function __get($property){

        if($this->container->{property}){

            return $this->container->{property}
        }

    }


}


?>