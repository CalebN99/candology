<?php

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

    // CONSTRUCTOR
    function __construct($fname, $lname, $userId, $email, $street, $address2, $city, $zip, $state, $cardNum, $cardExpMonth, $cardExpYear, $cvv) {
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
     * @return mixed
     */
    function getFName() {
        return $this->_fname;
    }

    /**
     * @return mixed
     */
    function getLName() {
        return $this->_lname;
    }

    /**
     * @return mixed
     */
    function getuserId() {
        return $this->_userId;
    }

    /**
     * @return mixed
     */
    function getEmail() {
        return $this->_email;
    }

    /**
     * @return mixed
     */
    function getStreet() {
        return $this->_street;
    }

    /**
     * @return mixed
     */
    function getAddress2() {
        return $this->_address2;
    }

    /**
     * @return mixed
     */
    function getCity() {
        return $this->_city;
    }

    /**
     * @return mixed
     */
    function getZip() {
        return $this->_zip;
    }

    /**
     * @return mixed
     */
    function getState() {
        return $this->_state;
    }

    /**
     * @return mixed
     */
    function getCardNum() {
        return $this->_cardNum;
    }

    /**
     * @return mixed
     */
    function getCardExpMonth() {
        return $this->_cardExpMonth;
    }

    /**
     * @return mixed
     */
    function getCardExpYear() {
        return $this->_cardExpYear;
    }

    /**
     * @return mixed
     */
    function getCVV() {
        return $this->_cvv;
    }





}