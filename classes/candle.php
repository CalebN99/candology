<?php

class Candle extends Product
{

    private $_scent;

    public function __construct($productId, $productName, $productDescription, $productQTY, $price, $scent)
    {
        $this->_scent = $scent;
        parent::__construct($productId, $productName, $productDescription, $productQTY, $price);
    }


    function getScent() {
        return $this->_scent;
    }


}