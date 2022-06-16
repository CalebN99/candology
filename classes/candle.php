<?php

/**
 * Candle is a Product that also has a specified burn time.
 */
class Candle extends Product
{
    private $_burntime;

    /**
     * Constructor method for Candle class that calls parents constructor
     * @return void
     */
    public function __construct($productId, $productName, $productDescription, $productQTY, $price, $burntime)
    {
        parent::__construct($productId, $productName, $productDescription, $productQTY, $price);
        $this->_burntime = $burntime;
    }


    /**
     * Method to return $_burntime variable
     * @return int burn time of the candle
     */
    function getBurn()
    {
        return $this->_burntime;
    }


}