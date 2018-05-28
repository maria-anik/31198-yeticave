<?php

    require_once("functions.php");
    require_once("config.php");
    require_once("db.php");

    if ($con) {
        unset($_SESSION["user"]);
        session_destroy();

        header("Location: /index.php");
        exit();
    };
