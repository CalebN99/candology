<?php

/**
 * Product class container for basic product information.
 * Parent class to Candle and Diffuser classes.
 */
class Product
{
    // FIELDS
    private $_productId;
    private $_productName;
    private $_productDescription;
    private $_productQTY;
    private $_price;

    // CONSTRUCTOR
    function __construct($productId, $productName, $productDescription, $productQTY, $price)
    {
        $this->_productId = $productId;
        $this->_productName = $productName;
        $this->_productDescription = $productDescription;
        $this->_productQTY = $productQTY;
        $this->_price = $price;
    }

    // GET METHODS

    /**
     * Method to get the unique product identifier used in the database
     * @return int unique id of the product
     */
    function getProductId()
    {
        return $this->_productId;
    }

    /**
     * Method to get the name of the product
     * @return string name of the product
     */
    function getProductName()
    {
        return $this->_productName;
    }

    /**
     * Method to get the full description of the product
     * @return string detailed product description
     */
    function getProductDescription()
    {
        return $this->_productDescription;
    }

    /**
     * Method to get the quantity of the product //TODO: Is this quantity in cart or quantity in stock
     * @return int quantity of the product
     */
    function getProductQTY()
    {
        return $this->_productQTY;
    }

    /**
     * Method to get the price of product
     * @return string detailed product description
     */
    function getPrice()
    {
        return $this->_price;
    }


}