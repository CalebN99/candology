<?php

class Candle extends Product
{
    private $_burntime;

    public function __construct($productId, $productName, $productDescription, $productQTY, $price, $burntime)
    {
        parent::__construct($productId, $productName, $productDescription, $productQTY, $price);
        $this->_burntime = $burntime;
    }


    function getBurn() {
        return $this->_burntime;
    }


}