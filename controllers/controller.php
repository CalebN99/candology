<?php

class Controller
{

    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function login() {
        $view = new Template();
        echo $view->render('views/login.html');
    }

    function createAccount() {
        $view = new Template();
        echo $view->render('views/createAccount.html');
    }


}