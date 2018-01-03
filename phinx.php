<?php


    require __DIR__."/bootstrap/app.php";

    $config = $container['settings']['db'];

        return [
            "paths" => [
                "migrations" => "app/migrations"
            ],
            "template"=>"app/migrations/migrationtemplate.php",
            "base_migration_class"=>"app/migrations/migration",
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