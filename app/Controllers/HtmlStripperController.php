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
    use DealsWithGold\Models\Xbox360;
    use DealsWithGold\Models\XboxOneResources;
    use Slim\Views\Twig;
    // use Sunra\PhpSimple\HtmlDomParser;

    Class HtmlStripperController extends Controller{

        protected $url = "https://www.xbox.com/";
        protected $query_string = "/live/deals-with-gold";
        public $box_shot = "https://www.xbox.com/en-gb/global-resources/templates/MWF/JS/MWF-Aria-Boxshots-loc.js";
        public $main_jsonurl = "https://www.xbox.com/en-gb/live/deals-with-gold/js/dwg-globalContent.json";
        public $html_result, $json_result, $view, $json_obj, $dbconn, $xbox1_game_count, $xbox360_game_count;
        public $bigIdimg = array();

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
             $this->executeXboxOneGames();
             $this->executeXbox360Games();
             $this->executeXboxOneResourceDb();
             //$this->executeObject();
             
        }

        public function executeXboxOneGames(){

              Xboxone::truncate();
              $localeIns = $this->json_obj['globalContent']['locales']['en-gb'];

              //run through the looped db
                for($qty=1; $qty<=$this->xbox1_game_count; $qty++){

                    Xboxone::create(["game_name"=>$localeIns["keyX1gamename$qty"], "game_aria_label"=>"Learn More about ".$localeIns["keyX1gamename$qty"], "game_bigid"=>$localeIns["keyX1gamebigid$qty"], 
                    "game_discount"=>$localeIns["keyX1gameofftext$qty"], "game_include"=>$localeIns["keyX1gameinclude$qty"], 
                    "game_exclude"=>$localeIns["keyX1gameexclude$qty"], "game_data_click_name"=>"www>live>deals-with-gold>".preg_replace("/ /","-",preg_replace("/: /","-",$localeIns["keyX1gamename$qty"])).">click"]);

                }
                
        }

        public function executeXbox360Games(){

            Xbox360::truncate();
            $localeInsl = $this->json_obj['globalContent']['locales']['en-gb'];
            //run through the looped db
              for($qtyy=1; $qtyy<=$this->xbox360_game_count; $qtyy++){
                
                    Xbox360::create(["game_name"=>$localeInsl["keyX360gamename$qtyy"],"game_link"=>$localeInsl["keyX360gameurl$qtyy"], "game_box_shot"=>$localeInsl["keyX360gameboxshot$qtyy"],
                    "game_discount"=>$localeInsl["keyX360gameofftext$qtyy"], "game_include"=>$localeInsl["keyX360gameinclude$qtyy"], 
                    "game_exclude"=>$localeInsl["keyX360gameexclude$qtyy"]]);

              }

        }

                //run through the saved xbox games for resource fetching
        public function executeXboxOneResourceDb(){
                XboxOneResources::truncate();
                $getAllX1 = Xboxone::all();

                foreach($getAllX1 AS $eachRowBro){
                    
                    $requestJsonFile = file_get_contents("https://displaycatalog.mp.microsoft.com/v7.0/products?bigIds=".$eachRowBro->game_bigid."&market=gb&languages=en-gb&MS-CV=DGU1mcuYo0WMMp+F.1");
                    $resourceObjectFile = json_decode($requestJsonFile, true); 

                    $resImage = $resourceObjectFile['Products'][0]['LocalizedProperties'][0]['Images'][1]['Uri'];
                    $this->bigIdimg[$eachRowBro->game_bigid] = $resImage;
                    //$ary = array_map('strval', $this->bigIdimg);
                    XboxOneResources::create(["game_name"=>$eachRowBro->game_name, "game_aria_label"=>$eachRowBro->game_aria_label, "game_bigid"=>$eachRowBro->game_bigid, "game_box_art"=>$this->bigIdimg[$eachRowBro->game_bigid], "game_include"=>$eachRowBro->game_include, "game_exclude"=>$eachRowBro->game_exclude, "game_discount"=>$eachRowBro->game_discount, "game_data_click_name"=>$eachRowBro->game_data_click_name]);

                }

        }

        //handle request from site
        public function returnDbJson($request, $response){

                //$reqlocale = $request->getParsedBodyParam("locale");

                //$xboxOne = Xboxone::all();
                $xbo360 = Xbox360::all();
                $xboxOneResources = XboxOneResources::all();

                return $response->withJson(["xboxone"=>$xboxOneResources,"xbox360"=>$xbo360], 200);

        }

        public function returnDbLocaleJson($request, $response){
            
                $reqlocale = $request->getParsedBodyParam("locale");
            
                $xboxOne = Xboxone::all();
                $xbo360 = Xbox360::all();
            
                return $response->withJson(["xboxone"=>$xboxOne,"xbox360"=>$xbo360], 200);
            
        }

    }

?>