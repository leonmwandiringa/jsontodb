<?php

    require __DIR__."/../vendor/autoload.php";
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    $app = new \Slim\App(

        [
            "settings"=>[
                "displayErrorDetails"=>true,
                "cache"=>false
            ],["db"=>

            [
                "name"=>"dealswithgold", 
                "host"=>"localhost", 
                "user"=>"dealswithgold", 
                "password"=>"Dealswithgold1"
                ]
            
            ]
        ]

    );

    $container = $app->getContainer();

    //dependency injection for views rendering
    $container['view'] = function($container){
        
        $view = new \Slim\Views\Twig(['resources/views']);

        return $view;
        
    };

    //add pdo to container
    $container['db'] = function($container){

        $db = $container['db'];

        $pdo = new PDO("mysql:host=".$db['host'].";dbname=".$db['name'], $db['user'], $db['password']);
        $pdo->setAttribute(PDO::ATT_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::DEFUALT_FETCH_MODE, PDO::FETCH_OBJ);

        return $pdo;

    };
    //dependncy injection for stripper controller
    $container['HtmlStripperController'] = function($container){

        return new \DealsWithGold\Controllers\HtmlStripperController($container);

    };

    require __DIR__."/../routes/web.php";

?>