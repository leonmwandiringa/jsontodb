<?php

    require __DIR__."/../vendor/autoload.php";
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    $app = new \Slim\App(

        [
            "settings"=>[
                "displayErrorDetails"=>true,
                "cache"=>false
            ]
        ]

    );


    $container = $app->getContainer();

    //dependency injection for views rendering
    $container['view'] = function($container){
        
        $view = new \Slim\Views\Twig(['resources/views', [
            'cache'=>false
        ]]);


        return $view;
        
    };
    //dependncy injection for stripper controller
    $container['HtmlStripperController'] = function($container){

        return new \DealsWithGold\Controllers\HtmlStripperController($container->view);

    };

    require __DIR__."/../routes/web.php";

?>