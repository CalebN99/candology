<?php

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

//session_start();

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();

//Create an instance of the Controller class
$con = new Controller($f3);

//Define a default route
$f3->route('GET /', function() {

    $GLOBALS['con']->home();
});

//Login page route
$f3->route('GET /login', function () {
    $GLOBALS['con']->login();
});

//Create Account Page
$f3->route('GET /newAccount', function () {
    $GLOBALS['con']->createAccount();
});


//Run f3
$f3->run();