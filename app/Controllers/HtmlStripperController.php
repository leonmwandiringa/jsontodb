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

        protected $url = "https://www.xbox.com/";
        protected $html_result;

        private function runExec($request, $response){
            return "fd";
            //$this->html_result = file_get_html($url);
            //return $this->html_result;
            // foreach(parent::getLocales() AS $key=>$value){


            // }
        }

    }

?>