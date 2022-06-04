<?php

class Diffuser extends Product
{
    private $_size;


    public function __construct($productId, $productName, $productDescription, $productQTY, $_price, $size)
    {
        $this->_size = $size;
        parent::__construct($productId, $productName, $productDescription, $productQTY, $_price);
    }


    function getSize() {
        return $this->_size;
    }

}