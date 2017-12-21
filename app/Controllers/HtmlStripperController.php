<?php
/**
 * @author Leon
 * @return void
 * @uses run the code stripping loop provided loacales
 * 
 */
    namespace DealsWithGold\Controllers;
    use DealsWithGold\Helpers\LocalesHelper;

    Class HtmlStripperController extends LocalesHelper{

        protected $Url = "https://www.xbox.com/";

        private function runExec($request, $response){


            foreach(parent::getLocales() AS $key=>$value){


            }
        }

    }

?>