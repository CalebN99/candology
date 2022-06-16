<?php

/**
 * User class encapsulates customer information.
 */
class User
{
    private $_fname;
    private $_lname;
    private $_userId;
    private $_email;
    private $_street;
    private $_address2;
    private $_city;
    private $_zip;
    private $_state;
    private $_cardNum;
    private $_cardExpMonth;
    private $_cardExpYear;
    private $_cvv;

    /**
     * Constructor for User class, Stores customer account information
     * @return void
     */
    public function __construct($fname, $lname, $userId, $email, $street, $address2, $city, $zip, $state, $cardNum, $cardExpMonth, $cardExpYear, $cvv)
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_userId = $userId;
        $this->_email = $email;
        $this->_street= $street;
        $this->_address2 = $address2;
        $this->_city = $city;
        $this->_zip = $zip;
        $this->_state = $state;
        $this->_cardNum = $cardNum;
        $this->_cardExpMonth= $cardExpMonth;
        $this->_cardExpYear= $cardExpYear;

        $this->_cvv = $cvv;
    }

    /**
     * Method to return $_fname variable
     * @return mixed first name, null if unset
     */
    function getFName()
    {
        return $this->_fname;
    }

    /**
     * Method to return $_lname variable
     * @return mixed last name, null if unset
     */
    function getLName()
    {
        return $this->_lname;
    }

    /**
     * Method to return $_userId variable
     * @return mixed
     */
    function getuserId()
    {
        return $this->_userId;
    }

    /**
     * Method to return $_email variable
     * @return mixed
     */
    function getEmail()
    {
        return $this->_email;
    }

    /**
     * Method to return $_street variable
     * @return mixed
     */
    function getStreet()
    {
        return $this->_street;
    }

    /**
     * Method to return $_address2 variable
     * @return mixed
     */
    function getAddress2()
    {
        return $this->_address2;
    }

    /**
     * Method to return $_city variable
     * @return mixed
     */
    function getCity()
    {
        return $this->_city;
    }

    /**
     * Method to return $_zip variable
     * @return mixed
     */
    function getZip()
    {
        return $this->_zip;
    }

    /**
     * Method to return $_state variable
     * @return mixed
     */
    function getState()
    {
        return $this->_state;
    }

    /**
     * Method to return $_cardNum variable
     * @return mixed
     */
    function getCardNum()
    {
        return $this->_cardNum;
    }

    /**
     * Method to return $_cardExpMonth variable
     * @return mixed
     */
    function getCardExpMonth()
    {
        return $this->_cardExpMonth;
    }

    /**
     * Method to return $_cardExpYear variable
     * @return mixed
     */
    function getCardExpYear()
    {
        return $this->_cardExpYear;
    }

    /**
     * Method to return $_cvv variable
     * @return mixed
     */
    function getCVV()
    {
        return $this->_cvv;
    }





}