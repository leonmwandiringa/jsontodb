<?php

    $app->get("/lstp", "HtmlStripperController:runExec");

    $app->get("/", function(){

        return "yep";
    });


?>