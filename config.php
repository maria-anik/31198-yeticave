<?php
    date_default_timezone_set("Europe/Moscow");
    setlocale(LC_ALL, "ru_RU");

    ini_set("session.cookie_lifetime", 86400);
    ini_set("session.gc_maxlifetime", 86400);
    session_start();

    define("minute", 60);
    define("hour", 3600);
    define("day", 86400);

    define('SERVER', "localhost");
    define("DB", "yeticave");
    define("LOGIN", "root");
    define("PASSWORD", "");

    $front = false;
