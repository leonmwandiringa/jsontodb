<?php

    require __DIR__."/../vendor/autoload.php";

    $app = new \Slim\App(

        [
            "settings"=>[
                "displayErrorDetails"=>true
            ]
        ]

    );

    $container = $app->getContainer();

    $container['HtmlStripperController'] = function(){

        return new \DealsWithGold\Controllers\HtmlStripperController;

    };

    require __DIR__."/../routes/web.php";



?>