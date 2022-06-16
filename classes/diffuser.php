<?php

// Diffuser Class extends Product class
class Diffuser extends Product
{
    private $_scent;

    /**
     * Constructor for Diffuser that calls parent constructor
     * @return void
     */
    public function __construct($productId, $productName, $productDescription, $productQTY, $price, $scent)
    {
        parent::__construct($productId, $productName, $productDescription, $productQTY, $price);
        $this->_scent = $scent;
    }

    /**
     * Method to return $_scent variable
     * @return $_scent - String
     */
    function getScent()
    {
        return $this->_scent;
    }

    /**
     * Method that takes parameter and sets $_scent variable to parameter
     * @return void
     */
    function setScent($scent) {
        $this->_scent = $scent;
    }
}