<?php

// Error Reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);


//Require the autoload file
require_once('vendor/autoload.php');

session_start();

//Create an instance of the Base class (Fat-Free)
$f3 = Base::instance();

// Instantiate Global Objects
$con = new Controller($f3);
$valid = new Validation();
$datalayer = new DataLayer();


//Define a default route
$f3->route('GET /', function() {

    $GLOBALS['con']->home();
});

//Login page route
$f3->route('GET|POST /login', function () {
    $GLOBALS['con']->login();
});

//Logout page route
$f3->route('GET|POST /logout', function () {
    $GLOBALS['con']->logout();
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
    $GLOBALS['con']->ourCollections($GLOBALS['datalayer']->getProducts());
});

// View Candle Products (Browse Products)
$f3->route('GET|POST /browse_candles', function() {
    $GLOBALS['con']->ourCollections($GLOBALS['datalayer']->getCandles());
});

// View Diffuser Products (Browse Products)
$f3->route('GET|POST /browse_diffusers', function() {
    $GLOBALS['con']->ourCollections($GLOBALS['datalayer']->getDiffusers());
});

// View Individual Product Page (More info)
$f3->route('GET|POST /product_page', function() {
    $GLOBALS['con']->productPage();
});



// About Us
$f3->route('GET|POST /about_us', function() {
    $GLOBALS['con']->aboutUs();
});

// Contact Us
$f3->route('GET|POST /contact_us', function() {
    $GLOBALS['con']->contactUs();
});



// Checkout
$f3->route('GET|POST /checkout', function() {
    $GLOBALS['con']->checkout();
});


//Run f3
$f3->run();