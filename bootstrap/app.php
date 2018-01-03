<?php

    require __DIR__."/../vendor/autoload.php";
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    $app = new \Slim\App(

        [
            "settings"=>[
                "displayErrorDetails"=>true,
                "cache"=>false,
                'db' => [
                    'driver' => 'mysql',
                    'host' => 'localhost',
                    'database' => 'dealswithgold',
                    'username' => 'dealswithgold',
                    'password' => 'Dealswithgold1',
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => '',
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

    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    
    $container['db'] = function ($container) {
        return $capsule;
    };
    
    //add pdo to container
    // $container['db'] = function($container){

    //     $db = $container['settings']['db'];

    //     $pdo = new PDO("mysql:host=".$db['host'].";dbname=".$db['name'], $db['user'], $db['password']);
    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     $pdo->setAttribute(PDO::DEFUALT_FETCH_MODE, PDO::FETCH_OBJ);

    //     return $pdo;

    // };

    // $container['dbMaster'] = function($container){

    //     return new \DealsWithGold\Models\DbRun($container);

    // };
    //dependncy injection for stripper controller
    $container['HtmlStripperController'] = function($container){

        return new \DealsWithGold\Controllers\HtmlStripperController($container);

    };

    require __DIR__."/../routes/web.php";

?>