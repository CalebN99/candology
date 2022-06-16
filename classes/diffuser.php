<?php

/**
 * Diffuser is a Product that has a scent option when purchasing.
 */
class Diffuser extends Product
{
    private $_scent;

    /**
     * Constructor for Diffuser. Calls parent constructor and sets scent option
     *
     * @param int $productId Product ID of the diffuser
     * @param string $productName Name of the diffuser product
     * @param string $productDescription Description of product
     * @param int $productQTY Quantity of product in stock
     * @param float $price Unit price of product
     * @param string $scent Selected oil scent for diffuser
     * @return void
     */
    public function __construct($productId, $productName, $productDescription, $productQTY, $price, $scent)
    {
        parent::__construct($productId, $productName, $productDescription, $productQTY, $price);
        $this->_scent = $scent;
    }

    /**
     * Method to return the scent of the diffuser oil
     * @return string scent of the diffuser oil
     */
    function getScent()
    {
        return $this->_scent;
    }

    /**
     * Method that takes parameter and sets $_scent variable to parameter
     * @param string $scent selected scent of the diffuser oil
     * @return void
     */
    function setScent($scent)
    {
        $this->_scent = $scent;
    }
}