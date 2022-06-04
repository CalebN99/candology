<?php

class Candle extends Product
{

    private $_scent;

    public function __construct($productId, $productName, $productDescription, $productQTY, $_price, $scent)
    {
        $this->_scent = $scent;
        parent::__construct($productId, $productName, $productDescription, $productQTY, $_price);
    }


    function getScent() {
        return $this->_scent;
    }


}