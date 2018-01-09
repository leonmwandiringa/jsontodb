<?php

    $app->post("/fetch", "HtmlStripperController:runHtmlFetch");

    $app->post("/json", "HtmlStripperController:runJsonFetch");

    $app->get("/getgames", "HtmlStripperController:returnDbJson");

    // $app->post("/json", function($request, $respnse){

    //     echo $request->getParsedBody()['url'];
    //  });

    $app->get("/", function($request, $response){

        return $this->view->render($response, "filestripper.php");

    });

    $app->post("/insert/{locale}/{pagedata}", "HtmlStripperController:insertData");



?>