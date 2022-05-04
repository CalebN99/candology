<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home.html');

});

//Login page route
$f3->route('GET /login', function () {
    $view = new Template();
    echo $view->render('views/loginPage.html');
});


//Run f3
$f3->run();