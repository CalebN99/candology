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
        if (isset($_SESSION['successMessage'])) {
            $this->_f3->set('success', $_SESSION['successMessage']);
            $_SESSION['successMessage'] = null;
        }
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * Method to load the login page and validate login info
     * @return void
     */
    function login()
    {
        // If user submitted login form
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Query database for user
            $user = $GLOBALS['datalayer']->login($_POST['email'], $_POST['password']);

            // Validate user
            if ($user instanceof User) {
                $_SESSION['user'] = $user;
                $_SESSION['successMessage'] = array("header" => "Logged in", "message" => "Welcome, " . $user->getFName());
                header('location:../candology');
            } else if($user instanceof Admin) {
                $_SESSION['user'] = $user;
                header('location: admin');
            } else {
                $this->_f3->set('errors["login"]', 'Invalid Email or Password..');
            }
        }

        // Display page
        $view = new Template();
        echo $view->render('views/login.html');
    }


    /**
     * Method to logout the user. Clears the session (cart and user data)
     */
    function logout()
    {
        session_destroy();
        header('Location: ' . $this->_f3['BASE']);
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
                $_SESSION['fname'] = ucfirst($_POST['fname']);
            }

            // Validating last name

            if ($GLOBALS['valid']->validLName($_POST['lname'])) {
                $this->_f3->set('errors["lname"]', 'Valid last name required');
                $valid = false;
            } else {
                $_SESSION['lname'] = ucfirst($_POST['lname']);
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
        // Create Account
        $GLOBALS['datalayer']->createAccount();

        // Login to account
        $user = $GLOBALS['datalayer']->login($_SESSION['email'], $_SESSION['password']);
        unset($_SESSION['password']);

        if ($user instanceof User) {
            $_SESSION['user'] = $user;
        } else {
            $this->_f3->set('errors["login"]', 'Error Logging in');
        }

        $view = new Template();
        echo $view->render('views/accountSummary.html');
    }

    /**
     * Method to Route the user to the browse products page. Displays all
     * passed products.
     *
     * @return void
     */
    function ourCollections($products)
    {
        if (isset($_SESSION['successMessage'])) {
            $this->_f3->set('success', $_SESSION['successMessage']);
            $_SESSION['successMessage'] = null;
        }

        $this->_f3->set('products', $products);

        $view = new Template();
        echo $view->render('views/browseProducts.html');
    }

    function aboutUs()
    {
        $view = new Template();
        echo $view->render('views/about_us.html');
    }


    function contactUs()
    {
        $view = new Template();
        echo $view->render('views/contact_us.html');
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

        // LOADING PAGE (First time)
        // Get ID of product to display
        if (isset($_POST['productId'])) {
            $product = $GLOBALS['datalayer']->getProduct($_POST['productId']);

            // If id product ID was not found, $product == false
            $_SESSION['prodView'] = $product;
        }


        // ADD TO CART IS CLICKED
        // If Post and ID set, add to cart
        if (isset($_POST['qty']) && isset($_POST['id'])) {
            $prod = $GLOBALS['datalayer']->getProduct($_POST['id']);

            if ($prod == false) {
                $this->_f3->set('errors["noProd"]', 'Product not found');
            } else {
                $_SESSION['prodView'] = $prod;
            }

            if ($prod instanceof Diffuser) {
                if(!$GLOBALS['valid']->validateScent($_POST['scent'])) {
                    $this->_f3->set('errors["scent"]', 'Invalid Scent');
                }
            }


            if ($_POST['qty'] < 1) {
                $this->_f3->set('errors["qty"]', 'Invalid Quantity');
            } else if ($_POST['qty'] > $prod->getProductQTY()) {
                $this->_f3->set('errors["qty"]', 'Requested quantity not available');
            }

            if(empty($this->_f3->get('errors'))) {
                // Create instance of cart if it doesn't exist
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = new Cart();
                }

                // Add product/s to cart
                if ($prod instanceof Diffuser) {
                    $_SESSION['cart']->addProduct($_POST['id'], $_POST['qty'], $_POST['scent']);
                } else {
                    $_SESSION['cart']->addProduct($_POST['id'], $_POST['qty']);
                }

                // Checking if product was added to cart
                $valid = false;
                foreach ($_SESSION['cart']->getCart() as $item) {
                    if($item['prod']->getProductId() == $_POST['id'] && $item['qty'] == $_POST['qty']) {
                        $valid = true;
                    }
                }

                if($valid) {
                    $_SESSION['successMessage'] =  array("header" => "Added to cart!", "message" => $prod->getProductName());
                    header('location: our_collections');
                }

            }
        }

        // Redirect to our Collections if product id is invalid
        if ($_SESSION['prodView'] == false) {
            header('location: our_collections');
        }
        else {
            $scents = $GLOBALS['datalayer']->getScents();
            $this->_f3->set("scents", $scents);

            // Store the product object in the hive
            $this->_f3->set('product', $_SESSION['prodView']);

            // Render product page
            $view = new Template();
            echo $view->render('views/product.html');
        }
    }

    /**
     * @return void
     */
    function checkout()
    {
        // Check if user is has account/is logged in
        if (!isset($_SESSION['user'])) {
            $_SESSION['createAccOnCheck'] = true;
            header('location: login');
        }
        // Checks if Order is being placed
        else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Only place order if cart exists
            if (isset($_SESSION['cart'])) {
                $GLOBALS['datalayer']->placeOrder();
                $_SESSION['successMessage'] = array("header" => "Successfully placed order", "message" => "Thank you, " . $_SESSION['user']->getFName());
            }

            // Clear Cart
            $_SESSION['cart'] = new Cart();


            // Redirect to home
            header('Location: ' . $this->_f3['BASE']);
        }
        else {
            $this->_f3->set('states', DataLayer::getStatesMap());

            $view = new Template();
            echo $view->render('views/checkout.html');
        }
    }

    /**
     * Method to load the admin page. Redirects the user to the home page if
     * user is not signed in as admin. Also requests orders and products from
     * the database to be displayed to the admin.
     */
    function admin()
    {
        // Validate that the user account is logged in as admin
        if(!($_SESSION['user'] instanceof Admin)) {
            header('Location: ' . $this->_f3['BASE']);
        }
        else {

            // Check for POST (Order was fulfilled)
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                // Get OrderId
                $orderID = $_POST['orderId'];

                // Fulfill Order
                $GLOBALS['datalayer']->fulfillOrder($orderID);
            }

            // Puts the orders in SESSION['orders']
            $GLOBALS['datalayer']->getAllOrders();

            // Stores the list of all products in the hive
            $this->_f3->set('products', $GLOBALS['datalayer']->getProducts());

            // Load admin page
            $view = new Template();
            echo $view->render('views/admin.html');
        }
    }

    function adminQuantityUpdate()
    {
        if(!($_SESSION['user'] instanceof Admin)) {
            header('Location: ' . $this->_f3['BASE']);
        }
        else {
            $view = new Template();
            echo $view->render('scripts/updateProductQTY.php');
        }
    }
}