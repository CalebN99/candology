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

    function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $user = $GLOBALS['datalayer']->login($_POST['email'], $_POST['password']);


                if (is_array($user)) {
                    $_SESSION['user'] = new User($user['fname'], $user['lname'], $user['userId'], $user['email'], $user['street'], $user['address2'], $user['city'], $user['zip'],
                        $user['state'], $user['cardNum'], $user['cardExpMonth'], $user['cardExpYear'], $user['cvv']);
                    $_SESSION['cart'] = new Cart();
                    header('location:../candology');
                } else {
                    $this->_f3->set('errors["login"]', 'Invalid Email or Password..');
                }


            }


        $view = new Template();
        echo $view->render('views/login.html');
    }

    function createAccount()
    {


        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $valid = true;

            // Validating first name
            if ($GLOBALS['valid']->validFName($_POST['fname'])) {
                $this->_f3->set('errors["fname"]', 'Valid first name required');
                $valid = false;
            } else {
                $_SESSION['fname'] = $_POST['fname'];
            }

            // Validating last name

            if ($GLOBALS['valid']->validLName($_POST['lname'])) {
                $this->_f3->set('errors["lname"]', 'Valid last name required');
                $valid = false;
            } else {
                $_SESSION['lname'] = $_POST['lname'];
            }

            // Validating email
            $email = $_POST['email'];
            if (!$GLOBALS['valid']->validEmail($email)) {
                $this->_f3->set('errors["email"]', 'Valid email required');
                $valid = false;
            } else {
                $_SESSION['email'] = $_POST['email'];
            }

            // Validating password

            if ($GLOBALS['valid']->validPassword($_POST['password'])) {
                $this->_f3->set('errors["password"]', 'Valid password required');
                $valid = false;
            } else {
                $_SESSION['password'] = $_POST['password'];
            }
            // Validating street address

            if ($GLOBALS['valid']->validStreet($_POST['street'])) {
                $this->_f3->set('errors["street"]', 'Valid street address required');
                $valid = false;
            } else {
                $_SESSION['street'] = $_POST['street'];
            }
            // Validating city

            if (  $GLOBALS['valid']->validCity($_POST['city'])) {
                $this->_f3->set('errors["city"]', 'Valid city required');
                $valid = false;
            } else {
                $_SESSION['city'] = $_POST['city'];
            }

            // Validating state
            $_SESSION['state'] = $_POST['state'];
            // Validating zip

            if ($GLOBALS['valid']->validZip($_POST['zip'])) {
                $this->_f3->set('errors["zip"]', 'Valid zip required');
                $valid = false;
            } else {
                $_SESSION['zip'] = $_POST['zip'];
            }
            // Validating card number

            if ($GLOBALS['valid']->validCardNum($_POST['cardNum'])) {
                $this->_f3->set('errors["cardNum"]', 'Valid card number required');
                $valid = false;
            } else {
                $_SESSION['cardNum'] = $_POST['cardNum'];
            }
            // Validating exp month

            if ($GLOBALS['valid']->validExpMonth($_POST['expMonth'])) {
                $this->_f3->set('errors["expMonth"]', 'Valid exp month required');
                $valid = false;
            } else {
                $_SESSION['expMonth'] = $_POST['expMonth'];
            }
            // Validating exp year

            if ($GLOBALS['valid']->validExpYear($_POST['expYear'])) {
                $this->_f3->set('errors["expYear"]', 'Valid exp year required');
                $valid = false;
            } else {
                $_SESSION['expYear'] = $_POST['expYear'];
            }
            // Validating cvv

            if ($GLOBALS['valid']->validCVV($_POST['cvv'])) {
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

        $this->_f3->set('states', DataLayer::getStatesMap());

        $view = new Template();
        echo $view->render('views/createAccount.html');
    }

    function accountSummary()
    {
        $GLOBALS['datalayer']->createAccount();
        $view = new Template();
        echo $view->render('views/accountSummary.html');
    }

    function ourCollections()
    {
        // Get products to display on page
        $products = $GLOBALS['datalayer']->getProducts();

        $this->_f3->set('products', $products);

        $view = new Template();
        echo $view->render('views/browseProducts.html');
    }

    /**
     * Method to get a product's info to be loaded onto page. Then redirects
     * to the view product page.
     * @return void
     */
    function productPage()
    {
        // If request method is not post Redirect to collections
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            header("location: our_collections");
        }


        // Get ID of product to display
        if (isset($_POST['productId'])) {
            $product = $GLOBALS['datalayer']->getProduct($_POST['productId']);
            if ($product == false) {
                header("location: our_collections");
            }
            $_SESSION['prodView'] = $product;
        }



        // If Post and ID set, add to cart
        if (isset($_POST['qty']) && isset($_POST['id'])) {
            $prod = $GLOBALS['datalayer']->getProduct($_POST['id']);

            if ($prod == false) {
                $this->_f3->set('errors["noProd"]', 'Product not found');
            } else {
                $_SESSION['prodView'] = $prod;
            }

            if ($_POST['qty'] < 1) {
                $this->_f3->set('errors["qty"]', 'Invalid Quantity');
            } else if ($_POST['qty'] > $prod->getProductQTY()) {
                $this->_f3->set('errors["qty"]', 'Requested quantity not available');
            }
           else {
                $_SESSION['cart']->addProduct($_POST['id'], $_POST['qty']);
                var_dump($_SESSION['cart']->getCart());
            }

        }

        $this->_f3->set('product', $_SESSION['prodView']);

        // If id product ID was not found, Redirect back to our collections


        // Store the product object in the hive


        // Render product page
        $view = new Template();
        echo $view->render('views/product.html');
    }

    function checkout()
    {
        $this->_f3->set('states', DataLayer::getStatesMap());

        $view = new Template();
        echo $view->render('views/checkout.html');
    }


}