<?php
/**
 * @author Leon
 * @return void
 * @uses run the code stripping loop provided loacales
 * 
 */
    namespace DealsWithGold\Controllers;
    use DealsWithGold\Helpers\LocalesHelper;
    use Slim\Views\Twig;
    // use Sunra\PhpSimple\HtmlDomParser;

    Class HtmlStripperController extends LocalesHelper{

        protected $url = "https://www.xbox.com/";
        public $view;
        public $html_result;

        public function __construct($view){

            $this->view = $view;
        }

        public function runFileStripper($request, $response){

                return $this->view->render($response, "filestripper.php");

        }

        public function runHtmlFetch($request, $response){
           
            // foreach(parent::getLocales() AS $key=>$value){


            // }
        }
        public function insertData($request, $response, $args){


        }

    }

?>