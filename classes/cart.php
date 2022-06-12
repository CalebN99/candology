<?php

class Cart
{

    private $_cart;


//    function __construct()
//    {
//        $this->_cart = (array) null;
//    }
//

    function addProduct($id, $qty)
    {
        $prod = $GLOBALS['datalayer']->getProduct($id);
        $this->_cart[] = ["prod"=>$prod, "qty"=>$qty];
    }

    function getCart()
    {
        return $this->_cart;
    }

    function getTotal()
    {
        $total = 0;
         foreach ($this->_cart as $order) {

            $total +=  $order['prod']->getPrice() * $order['qty'];
        }

         return $total;
    }

    function getTotalProducts()
    {
        $total = 0;
        foreach ($this->_cart as $order) {

            $total +=  $order['qty'];
        }

        return $total;
    }

    /**
     * Method to check if the cart has any items in it.
     * @return bool True if cart is empty, false otherwise
     */
    function isEmpty()
    {
        return empty($this->_cart);
    }


}