<?php

    $app->post("/fetch/{locale}", "HtmlStripperController:runHtmlFetch");

    $app->get("/", function($request, $response){

        return $this->view->render($response, "filestripper.php");

    });

    $app->post("/insert/{data}", "HtmlStripperController:insertData");



?>