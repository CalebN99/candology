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

        return $user;
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
        $sql = "SELECT * FROM products WHERE productType = 'candle'"; // TODO: Join with candles table for scent
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
                $scent = $row['scent'];

                $candle = new Candle($id, $name, $desc, $qty, $price, $scent);

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
        $sql = "SELECT * FROM products WHERE productType = 'diffuser'"; // TODO: Join with diffusers table for size
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
                $size = $row['size'];

                $diffuser = new Diffuser($id, $name, $desc, $qty, $price, $size);

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
    function getProduct(int $productId): Diffuser|bool|Candle
    {
        // Query database for product id
        $sql = "SELECT * FROM products WHERE productId = :id"; // TODO: Join with candles and diffusers tables

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(':id', $productId);

        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!empty($row)) {
            if ($row['productType'] == "candle") {
                $id = $row['productId'];
                $name = $row['productName'];
                $desc = $row['productDesc'];
                $qty = $row['productQTY'];
                $price = $row['price'];
                $scent = $row['scent'];

                return new Candle($id, $name, $desc, $qty, $price, $scent);
            }
            else if ($row['productType'] == "diffuser") {
                $id = $row['productId'];
                $name = $row['productName'];
                $desc = $row['productDesc'];
                $qty = $row['productQTY'];
                $price = $row['price'];
                $size = $row['size'];

                return new Diffuser($id, $name, $desc, $qty, $price, $size);
            }
        }
        return false;
    }
}