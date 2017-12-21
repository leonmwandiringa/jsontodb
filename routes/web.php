<?php

    $app->get("/lstp", "HtmlStripperController:runExec");

    $app->get("/", "HtmlStripperController:runFileStripper");


?>