<?php
class DataLayer
{

    /**
     * @var PDO
     *
     */
    private $_dbh;

    // DataLayer constructor

    function __construct()
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/../config.php');
        $this->_dbh = $dbh;
        $this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->_dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }


    function createAccount()
    {

        $sql = "INSERT INTO userAccounts (fname, lname, email, password, street, address2, city, zip, state, cardNum, cardExpMonth, cardExpYear, cvv) 
        VALUES (:fname, :lname, :email, :password, :street, :address2, :city, :zip, :state, :cardNum, :cardExpMonth, :cardExpYear, :cvv)";

        $statement = $this->_dbh->prepare($sql);


        $statement->bindParam(':fname', $_SESSION['fname'], PDO::PARAM_STR);
        $statement->bindParam(':lname', $_SESSION['lname'], PDO::PARAM_STR);
        $statement->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
        $statement->bindParam(':password', $_SESSION['password'], PDO::PARAM_STR);
        $statement->bindParam(':street', $_SESSION['street'], PDO::PARAM_STR);
        $statement->bindParam(':address2', $_SESSION['address2'], PDO::PARAM_STR);
        $statement->bindParam(':city', $_SESSION['city'], PDO::PARAM_STR);
        $statement->bindParam(':zip', $_SESSION['zip'], PDO::PARAM_INT);
        $statement->bindParam(':state', $_SESSION['state'], PDO::PARAM_STR);
        $statement->bindParam(':cardNum', $_SESSION['cardNum'], PDO::PARAM_STR);
        $statement->bindParam(':cardExpMonth', $_SESSION['expMonth'], PDO::PARAM_INT);
        $statement->bindParam(':cardExpYear', $_SESSION['expYear'], PDO::PARAM_STR);
        $statement->bindParam(':cvv', $_SESSION['cvv'], PDO::PARAM_STR);

        $statement->execute();
    }

    function login($email, $password)
    {

        $sql = "SELECT * FROM `userAccounts` WHERE email = :email AND password = :password LIMIT 1";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);

        $statement->execute();

        $user = $statement->fetch();

        if (!empty($user)) {
            if ($user['admin'] == 1) {
                return new Admin($user['userId'], $user['email']);
            } else {
                return new User($user['fname'], $user['lname'], $user['userId'], $user['email'],
                    $user['street'], $user['address2'], $user['city'], $user['zip'], $user['state'],
                    $user['cardNum'], $user['cardExpMonth'], $user['cardExpYear'], $user['cvv']);
            }

        }

        return false;
    }

    /**
     * Method to get all products sold. Returns an array of Product objects
     * which contain their product information.
     * @return array of all unique products sold
     */
    function getProducts(): array
    {
        // Get candles and diffusers
        $candles = $this->getCandles();
        $diffusers = $this->getDiffusers();

        // Return combined array of candles and diffusers
        return array_merge($candles, $diffusers);
    }

    /**
     * Method to get an array of unique candle objects containing product info
     * @return array of Candle objects containing product info
     */
    function getCandles(): array
    {
        // Query database for Candles
        $sql = "SELECT * FROM products
                INNER JOIN candles ON products.productId = candles.productId
                WHERE productType = 'candle'";

        $statement = $this->_dbh->prepare($sql);
        $statement->execute();

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Parse query results
        $candles = [];
        if (!empty($rows)) {

            // Encapsulate product info in Candle Objects
            foreach($rows as $row) {
                $id = $row['productId'];
                $name = $row['productName'];
                $desc = $row['productDesc'];
                $qty = $row['productQTY'];
                $price = $row['price'];
                $burntime = $row['burnTime'];

                $candle = new Candle($id, $name, $desc, $qty, $price, $burntime);

                // Add to output array
                $candles[] = $candle;
            }
        }
        // Return array of Candle Objects
        return $candles;
    }

    /**
     * Method to get an array of unique diffuser objects containing product info
     * @return array of Diffuser objects containing product info
     */
    function getDiffusers(): array
    {
        // Query database for Diffusers
        $sql = "SELECT * FROM products
                WHERE productType = 'diffuser'";

        $statement = $this->_dbh->prepare($sql);
        $statement->execute();

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Parse query results
        $diffusers = [];
        if (!empty($rows)) {

            // Encapsulate product info in Diffuser Objects
            foreach($rows as $row) {
                $id = $row['productId'];
                $name = $row['productName'];
                $desc = $row['productDesc'];
                $qty = $row['productQTY'];
                $price = $row['price'];
                $scent = $row['scent'];

                $diffuser = new Diffuser($id, $name, $desc, $qty, $price, $scent);

                // Add to output array
                $diffusers[] = $diffuser;
            }
        }
        // Return array of Diffuser Objects
        return $diffusers;
    }

    /**
     * Method to get a product using the product id. Returns a product object
     * (either Candle or Diffuser) depending on product type. Returns false if
     * id is not found in the database.
     *
     * @param int $productId id corresponding to unique product reference in
     * database
     * @return Diffuser|bool|Candle Returns Product object if id is found,
     * false otherwise
     */
    function getProduct(int $productId)
    {
        // Query to find product type
        $sql = "SELECT productType FROM products WHERE productId = :id";
        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':id', $productId);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // Query database for product using specified type
        if ($row['productType'] == 'candle') {
            // Query database for product id
            $sql = "SELECT * FROM products 
                INNER JOIN candles ON products.productId = candles.productId
                WHERE products.productId = :id";

            $statement = $this->_dbh->prepare($sql);
            $statement->bindParam(':id', $productId);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $id = $row['productId'];
            $name = $row['productName'];
            $desc = $row['productDesc'];
            $qty = $row['productQTY'];
            $price = $row['price'];
            $burntime = $row['burnTime'];

            return new Candle($id, $name, $desc, $qty, $price, $burntime);
        }
        else if ($row['productType'] == 'diffuser') {
            // Query database for product id
            $sql = "SELECT * FROM products 
                WHERE productId = :id";

            $statement = $this->_dbh->prepare($sql);
            $statement->bindParam(':id', $productId);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $id = $row['productId'];
            $name = $row['productName'];
            $desc = $row['productDesc'];
            $qty = $row['productQTY'];
            $price = $row['price'];
            $scent = null;

            return new Diffuser($id, $name, $desc, $qty, $price, $scent);
        }

        // Query was unsuccessful
        return false;
    }

    /**
     * Method to create place an order and store order information in the
     * database. Creates an order and then stores ordered products in
     * respective tables.
     * @return void
     */
    function placeOrder()
    {
        // Add order to the database
        $sql = "INSERT INTO orders(`customer_id`, `total_price`, `address`, `name`,`payment`, `fulfilled`) 
                VALUES (:userID,:totalPrice,:address,:userName,:payment, false)";
        $statement = $this->_dbh->prepare($sql);

        // Bind Parameters
        $user = $_SESSION['user'];
        $cart = $_SESSION['cart'];

        $address = $user->getStreet()." ".$user->getAddress2()." ".$user->getCity().", ".$user->getState()." ".
            $user->getZip();
        $payment = $user->getCardNum()." ".$user->getCardExpMonth()." ".$user->getCardExpYear()." ".$user->getCVV();
        $name = $user->getFName()." ".$user->getLName();

        $statement->bindParam(':userID', $_SESSION['user']->getuserID(), PDO::PARAM_INT);
        $statement->bindParam(':totalPrice', $cart->getTotal(), PDO::PARAM_STR);
        $statement->bindParam(':address', $address, PDO::PARAM_STR);
        $statement->bindParam(':userName', $name, PDO::PARAM_STR);
        $statement->bindParam(':payment', $payment, PDO::PARAM_STR);

        if($statement->execute()) {

            $orderID = $this->_dbh->lastInsertId();

            // Add Products to OrderedProducts table
            $products = $cart->getCart();
            foreach($products as $product) {
                if ($product['prod'] instanceof Diffuser) {
                    $sql = "INSERT INTO orderedProducts(`order_id`, `product_id`, `qty`, `productDetails`) 
                VALUES (:orderID, :productID, :qty, :details)";
                }
                else {
                    $sql = "INSERT INTO orderedProducts(`order_id`, `product_id`, `qty`) 
                VALUES (:orderID, :productID, :qty)";
                }


                $statement = $this->_dbh->prepare($sql);

                $productID = $product['prod']->getProductId();

                $statement->bindParam(':orderID', $orderID, PDO::PARAM_INT);
                $statement->bindParam(':productID', $productID, PDO::PARAM_INT);
                $statement->bindParam(':qty', $product['qty'], PDO::PARAM_INT);

                if ($product['prod'] instanceof Diffuser) {
                    $scent = $product['prod']->getScent();
                    $statement->bindParam(':details', $scent);
                }

                if($statement->execute()) {
                    // Decreases quantity of product with amount ordered
                    $sql = "UPDATE products SET productQTY = productQTY - :qty WHERE productId = :id";
                    $statement = $this->_dbh->prepare($sql);

                    $statement->bindParam(':qty', $product['qty'], PDO::PARAM_INT);
                    $statement->bindParam(':id', $productID, PDO::PARAM_INT);

                    $statement->execute();
                }
            }
        }
    }

    /**
     * Method to get an array of scents from the database. User can select a
     * a scent for their diffuser.
     * @return array of scents
     */
    function getScents()
    {
        $sql = "SELECT scent FROM scents";

        $statement = $this->_dbh->prepare($sql);
        $statement->execute();

        $scents = $statement->fetchAll(PDO::FETCH_ASSOC);

        $array = [];

        foreach ($scents as $scent) {
            $array[] = $scent['scent'];
        }
        return $array;
    }

    /**
     * Method to query the database for all the orders (fulfilled and
     * unfulfilled). Gets all the orders and their associated products.
     * @return void
     */
    function getAllOrders()
    {

        $_SESSION["orders"] = [];

        //Query all orders
        $sql = "SELECT * FROM orders";
        $statement = $this->_dbh->prepare($sql);
        $statement->execute();

        $orders = $statement->fetchAll(PDO::FETCH_ASSOC);


        // For each order, query all ordered products in that order
        foreach ($orders as $order) {

            $sql = "SELECT * FROM products
                INNER JOIN orderedProducts ON products.productId = orderedProducts.product_id
                WHERE orderedProducts.order_id = :id";

            $statement = $this->_dbh->prepare($sql);
            $statement->bindParam(':id', $order['order_id'], PDO::PARAM_INT);

            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

            $products = [];
            foreach ($rows as $row) {

                if ($row['productType'] == 'candle') {
                    $id = $row['productId'];
                    $name = $row['productName'];
                    $desc = $row['productDesc'];
                    $qty = $row['qty'];
                    $price = $row['price'];
                    $burntime = $row['productDetails'];

                    $products[] = new Candle($id, $name, $desc, $qty, $price, $burntime);

                } else {
                    $id = $row['productId'];
                    $name = $row['productName'];
                    $desc = $row['productDesc'];
                    $qty = $row['qty'];
                    $price = $row['price'];
                    $scent = $row['productDetails'];

                    $products[] = new Diffuser($id, $name, $desc, $qty, $price, $scent);
                }

            }
            $orderInfo = array("order"=>$order, "products"=>$products );

            $_SESSION["orders"][] = $orderInfo;
        }

        for($i = 0; $i < sizeof($_SESSION["orders"]); $i++) {
            $_SESSION["orders"][$i]["order"]["payment"] = explode(" ", $_SESSION["orders"][$i]["order"]["payment"]);
        }
    }

    /**
     * Method to fulfill an order given an order ID.
     * @param int $id OrderID of order to be fulfilled
     * @return void
     */
    function fulfillOrder($id)
    {
        $sql = "UPDATE orders SET fulfilled = 1 WHERE order_id = :id";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        $statement->execute();
    }

    /**
     * Method to update a product quantity in the database. This represents the
     * number of this product in stock.
     * @param int $id product id of product to update quantity
     * @param int $qty new quantity of product
     * @return void
     */
    function setQuantity($id, $qty)
    {
        // Query database to update product quantity
        $sql = "UPDATE products SET productQTY = :qty WHERE productId = :id";

        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':qty', $qty, PDO::PARAM_INT);

        $statement->execute();
    }

    /**
     * Method to get an array of states and their abbreviations.
     * @return string[] Map of state abbriviations to display name
     */
    static function getStatesMap()
    {
        return ["al"=>"Alabama", "ak"=>"Alaska", "az"=>"Arizona", "ar"=>"Arkansas",
            "ca"=>"California", "co"=>"Colorado", "ct"=>"Connecticut",
            "de"=>"Delaware", "dc"=>"District of Columbia", "fl"=>"Florida",
            "ga"=>"Georgia", "gu"=>"Guam", "hi"=>"Hawaii", "id"=>"Idaho",
            "il"=>"Illinois", "in"=>"Indiana", "ia"=>"Iowa", "ks"=>"Kansas",
            "ky"=>"Kentucky", "la"=>"Louisiana", "me"=>"Maine", "md"=>"Maryland",
            "ma"=>"Massachusetts", "mi"=>"Michigan", "mn"=>"Minnesota",
            "ms"=>"Mississippi", "mo"=>"Missouri", "mt"=>"Montana",
            "ne"=>"Nebraska", "nv"=>"Nevada", "nh"=>"New Hampshire",
            "nj"=>"New Jersey", "nm"=>"New Mexico", "ny"=>"New York",
            "nc"=>"North Carolina", "nd"=>"North Dakota",
            "cm"=>"Northern Mariana Islands", "oh"=>"Ohio", "ok"=>"Oklahoma",
            "or"=>"Oregon", "pa"=>"Pennsylvania", "pr"=>"Puerto Rico",
            "ri"=>"Rhode Island", "sc"=>"South Carolina", "sd"=>"South Dakota",
            "tn"=>"Tennessee", "tx"=>"Texas", "tt"=>"Trust Territories",
            "ut"=>"Utah", "vt"=>"Vermont", "va"=>"Virginia", "vi"=>"Virgin Islands",
            "wa"=>"Washington", "wv"=>"West Virginia", "wi"=>"Wisconsin",
            "wy"=>"Wyoming"];
    }
}