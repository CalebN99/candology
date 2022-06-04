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


}