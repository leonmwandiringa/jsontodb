<?php
/**
 * @author Leon
 * @return void
 * @uses run the code stripping loop provided loacales
 * 
 */
    namespace DealsWithGold\Controllers;
    use DealsWithGold\Helpers\LocalesHelper;
    use DealsWithGold\Models\DbRun;
    use Slim\Views\Twig;
    // use Sunra\PhpSimple\HtmlDomParser;

    Class HtmlStripperController extends LocalesHelper{

        protected $url = "https://www.xbox.com/";
        protected $query_string = "/live/deals-with-gold";
        public $view;
        public $box_shot = "https://www.xbox.com/en-gb/global-resources/templates/MWF/JS/MWF-Aria-Boxshots-loc.js";
        public $main_jsonurl = "https://www.xbox.com/en-gb/live/deals-with-gold/js/dwg-globalContent.json";
        public $html_result;
        public $json_result;
        public $json_obj;
        public $xbox1_game_count;
        public $xbox360_game_count;

        public function __construct($view){

            $this->view = $view;
        }

        public function runFileStripper($request, $response){

                return $this->view->render($response, "filestripper.php");

        }

        public function runHtmlFetch($request, $response){
            $req_locale = $request->getParsedBodyParam('locale');
            $this->html_result = file_get_contents($this->url . $req_locale . $this->query_string);
            //return $req_locale;
            return $this->html_result;

        }

        //was block with same origin csp, fetching raw ughh
        public function runJsonFetch($request, $response){

            $jsonurl = $request->getParsedBody()['url'];
            //echo $jsonurl;
             $this->json_result = "{".preg_replace('/globalContent = {/', '"globalContent":{', file_get_contents($jsonurl))."}";
             $this->json_obj = json_decode($this->json_result);
             //$obj_count = $this->json_obj->globalContent->locales->en
             $dn = "en-gb";
             $this->xbox1_game_count = $this->json_obj->globalContent->locales->$dn->keyXboxonenumber;
             $this->xbox360_game_count = $this->json_obj->globalContent->locales->$dn->keyXbox360number;
             foreach(parent::$_locales AS $locall => $locc){

                $localeIns = $this->json_obj->globalContent->locales->$locc;
                return self::insertData("SELECT * FROM xboxone");

             }
             
        }
        public static function insertData($localeIns){

            DbRun::runQuery($localeIns);
            // for($lg = 0; $lg <= $this->xbox1_game_count; $lg++){

                

            // }

        }

    }

?>