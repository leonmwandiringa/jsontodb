<?php


    require __DIR__."/bootstrap/app.php";

    $config = $container['settings']['db'];

        return [
            "paths" => [
                "migrations" => "app/Migrations"
            ],

            "migration_base_class"=>"DealsWithGold\Migrations\Core\Migration",

            "templates"=>[

                "file"=>"app/Migrations/Core/Migrationstub.php"
            ],
    
            "environments" => [
                "default_migration_table" => "migrations",
                "default" => [
                    "adapter" => $config['driver'],
                    "host" => $config['host'],
                    "name" => $config['database'],
                    "user" => $config['username'],
                    "pass" => $config['password'],
                    "port" => $config['port']
                ]
            ]
        ];






?>