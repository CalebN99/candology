<?php

class Diffuser extends Product
{
    private $_scent;

    public function __construct($productId, $productName, $productDescription, $productQTY, $price, $scent)
    {
        parent::__construct($productId, $productName, $productDescription, $productQTY, $price);
        $this->_scent = $scent;
    }

    function getScent()
    {
        return $this->_scent;
    }
}