<?php


error_reporting(E_ALL);
ini_set("display_errors", 1);

//session_start();

//Require the autoload file
require_once('vendor/autoload.php');

require_once('model/validation.php');
require_once('model/data-layer.php');

session_start();

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
$f3->route('GET|POST /new_account', function () {
    $GLOBALS['con']->createAccount();
});

//Account Summary
$f3->route('GET|POST /account_summary', function () {
    $GLOBALS['con']->accountSummary();
});

// Our Collections (Browse Products)
$f3->route('GET|POST /our_collections', function() {
    $GLOBALS['con']->ourCollections();
});

// Checkout
$f3->route('GET|POST /checkout', function() {
    $GLOBALS['con']->checkout();
});


//Run f3
$f3->run();