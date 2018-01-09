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
             $this->executeXboxOneGames();
             $this->executeXbox360Games();
             //$this->executeObject();
             
        }

        public function executeXboxOneGames(){

              Xboxone::truncate();
              $localeIns = $this->json_obj['globalContent']['locales']['en-gb'];

              //run through the looped db
                for($qty=1; $qty<=$this->xbox1_game_count; $qty++){

                    Xboxone::create(["game_name"=>$localeIns["keyX1gamename$qty"],"game_bigid"=>$localeIns["keyX1gamebigid$qty"], 
                    "game_discount"=>$localeIns["keyX1gameofftext$qty"], "game_include"=>$localeIns["keyX1gameinclude$qty"], 
                    "game_exclude"=>$localeIns["keyX1gameexclude$qty"]]);

                }
                $getAllX1 = Xboxone::all();
                foreach($getAllX1 AS $eachRowBrow){

                    $this->excuteResourceDb($eachRowBro);

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

        //handle request from site
        public function returnDbJson($request, $response){

                //$reqlocale = $request->getParsedBodyParam("locale");

                $xboxOne = Xboxone::all();
                $xbo360 = Xbox360::all();

                return $response->withJson(["xboxone"=>$xboxOne,"xbox360"=>$xbo360], 200);

        }

        public function returnDbLocaleJson($request, $response){
            
                $reqlocale = $request->getParsedBodyParam("locale");
            
                $xboxOne = Xboxone::all();
                $xbo360 = Xbox360::all();
            
                return $response->withJson(["xboxone"=>$xboxOne,"xbox360"=>$xbo360], 200);
            
        }

        public function excuteResourceDb($eachRowBro){
            
            $requestJsonFile = file_get_contents("https://displaycatalog.mp.microsoft.com/v7.0/products?bigIds=".$eachRowBrow->game_bigid."&market=gb&languages=en-gb&MS-CV=DGU1mcuYo0WMMp+F.1");
            $resourceObjectFile = json_decode($requestJsonFile, true);
            $resImage =  $resourceObjectFile['Products']['Images'][2]['Uri'];

            XboxOneResources::create(["game_name"=>$eachRowBro->game_name, "game_bigid"=>$eachRowBro->game_bigid, "game_box_art"=>$resImage]);

        }

    }

?>