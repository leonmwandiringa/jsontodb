<?php

    require __DIR__."/../vendor/autoload.php";
    use Xbox\Controllers\ApiController;
    

    $app = new \Slim\App(
        ["settings"=>[

            "displayErrorDetails"=>true,

        ]]

    );

    require __DIR__."/../routes/api.php";


?>