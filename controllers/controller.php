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
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $dataLayer = new DataLayer();

                $user = $dataLayer->login($_POST['email'], $_POST['password']);


                if (is_array($user)) {
                    $_SESSION['user'] = new User($user['fname'], $user['lname'], $user['userId'], $user['email'], $user['street'], $user['address2'], $user['city'], $user['zip'],
                        $user['state'], $user['cardNum'], $user['cardExpMonth'], $user['cardExpYear'], $user['cvv']);
                    header('location:../candology');
                } else {
                    $this->_f3->set('errors["login"]', 'Invalid Email or Password..');
                }


            }




        $view = new Template();
        echo $view->render('views/login.html');
    }

    function createAccount() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $valid = true;

            // Validating first name
            if (validFName($_POST['fname'])) {
                $this->_f3->set('errors["fname"]', 'Valid first name required');
                $valid = false;
            } else {
                $_SESSION['fname'] = $_POST['fname'];
            }

            // Validating last name
            if (validLName($_POST['lname'])) {
                $this->_f3->set('errors["lname"]', 'Valid last name required');
                $valid = false;
            } else {
                $_SESSION['lname'] = $_POST['lname'];
            }

            // Validating email
            $email = $_POST['email'];
            if (!validEmail($email)) {
                $this->_f3->set('errors["email"]', 'Valid email required');
                $valid = false;
            } else {
                $_SESSION['email'] = $_POST['email'];
            }

            // Validating password
            if (validPassword($_POST['password'])) {
                $this->_f3->set('errors["password"]', 'Valid password required');
                $valid = false;
            } else {
                $_SESSION['password'] = $_POST['password'];
            }
            // Validating street address
            if (validStreet($_POST['street'])) {
                $this->_f3->set('errors["street"]', 'Valid street address required');
                $valid = false;
            } else {
                $_SESSION['street'] = $_POST['street'];
            }
            // Validating city
            if (validCity($_POST['city'])) {
                $this->_f3->set('errors["city"]', 'Valid city required');
                $valid = false;
            } else {
                $_SESSION['city'] = $_POST['city'];
            }

            // Validating state
            $_SESSION['state'] = $_POST['state'];
            // Validating zip
            if (validZip($_POST['zip'])) {
                $this->_f3->set('errors["zip"]', 'Valid zip required');
                $valid = false;
            } else {
                $_SESSION['zip'] = $_POST['zip'];
            }
            // Validating card number
            if (validCardNum($_POST['cardNum'])) {
                $this->_f3->set('errors["cardNum"]', 'Valid card number required');
                $valid = false;
            } else {
                $_SESSION['cardNum'] = $_POST['cardNum'];
            }
            // Validating exp month
            if (validExpMonth($_POST['expMonth'])) {
                $this->_f3->set('errors["expMonth"]', 'Valid exp month required');
                $valid = false;
            } else {
                $_SESSION['expMonth'] = $_POST['expMonth'];
            }
            // Validating exp year
            if (validExpYear($_POST['expYear'])) {
                $this->_f3->set('errors["expYear"]', 'Valid exp year required');
                $valid = false;
            } else {
                $_SESSION['expYear'] = $_POST['expYear'];
            }
            // Validating cvv
            if (validCVV($_POST['cvv'])) {
                $this->_f3->set('errors["cvv"]', 'Valid cvv required');
                $valid = false;
            } else {
                $_SESSION['cvv'] = $_POST['cvv'];
            }

            if(empty($_POST['address2'])) {
                $_SESSION['address2'] = "";
            }


            if ($valid) {
                header('location: account_summary');
            }
        }
        $view = new Template();
        echo $view->render('views/createAccount.html');
    }

    function accountSummary() {
        $dataLayer = new DataLayer();

        $dataLayer->createAccount();
        $view = new Template();
        echo $view->render('views/accountSummary.html');
    }

    function ourCollections() {
        $view = new Template();
        echo $view->render('views/browseProducts.html');
    }

    function checkout() {
        $view = new Template();
        echo $view->render('views/checkout.html');
    }


}