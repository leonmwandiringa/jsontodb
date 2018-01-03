<?php
/**
 * @author Leon
 * @return void
 * @uses run the code stripping loop provided loacales
 * 
 */
    namespace DealsWithGold\Controllers;
    use DealsWithGold\Helpers\LocalesHelper;
    use DealsWithGold\Models\Xboxone;
    use Slim\Views\Twig;
    // use Sunra\PhpSimple\HtmlDomParser;

    Class HtmlStripperController extends Controller{

        protected $url = "https://www.xbox.com/";
        protected $query_string = "/live/deals-with-gold";
        public $view;
        public $box_shot = "https://www.xbox.com/en-gb/global-resources/templates/MWF/JS/MWF-Aria-Boxshots-loc.js";
        public $main_jsonurl = "https://www.xbox.com/en-gb/live/deals-with-gold/js/dwg-globalContent.json";
        public $html_result;
        public $json_result;
        public $json_obj;
        public $dbconn;
        public $xbox1_game_count;
        public $xbox360_game_count;

        // public function __construct($view){

        //     $this->view = $view;
        // }

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
             $this->json_obj = json_decode($this->json_result, true);
             //$obj_count = $this->json_obj->globalContent->locales->en
             $dn = "en-gb";
             //count items
             $this->xbox1_game_count = $this->json_obj['globalContent']['locales'][$dn]['keyXboxonenumber'];
             $this->xbox360_game_count = $this->json_obj['globalContent']['locales'][$dn]['keyXbox360number'];
             $this->executeObject();
             //$this->executeObject();
             
        }

        public function executeObject(){

            $reg_rep = ["/: /","/ /"];
            $localeIns = "";
            foreach(parent::$_locales AS $locall => $locc){
                //$qty=1;
               $localeIns = $this->json_obj['globalContent']['locales'][$locc];
              // return $localeIns;
                
                for($qty=1; $qty<=$this->xbox1_game_count; $qty++){

                    Xboxone::create(["game_name"=>$localeIns["keyX1gamename$qty"],"game_locale"=>$locall, "game_bigid"=>$localeIns["keyX1gamebigid$qty"], 
                    "game_discount"=>$localeIns["keyX1gameofftext$qty"], "game_include"=>$localeIns["keyX1gameinclude$qty"], 
                    "game_exclude"=>$localeIns["keyX1gameexclude$qty"]]);
                    // $this->runData("INSERT INTO xboxOne(game_name, game_bigid, game_data_click_name, game_discount, game_include, game_exclude) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)", 
                    // [$localeIns['keyX1gamename'.$qty], $localeIns['keyX1gamebigid'.$qty], $localeIns['keyX1gameofftext'.$qty], $localeIns['keyX1gameinclude'.$qty], $localeIns['keyX1gameexclude'.$qty]]);
               
                }
                //$qty++;
            }

        }

        public function runData($localeIns, $params = array()){
            $this->dbconn = $this->db->prepare($localeIns);
            $this->dbconn->execute($params);
            return $this->dbconn;

        }

    }

?>