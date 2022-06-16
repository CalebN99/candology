<?php

class Cart
{

    private $_cart;


//    function __construct()
//    {
//        $this->_cart = (array) null;
//    }
//

    /**
     * Checks if products exists then adds it to our $_cart variable
     * @return void
     */
    function addProduct($id, $qty, $scent=NULL)
    {
        $prod = $GLOBALS['datalayer']->getProduct($id);

        if($prod instanceof Diffuser) {
            $prod->setScent($scent);
        }
        $this->_cart[] = ["prod"=>$prod, "qty"=>$qty];
    }

    /**
     * Method to return $_cart variable
     * @return $_cart
     */
    function getCart()
    {
        return $this->_cart;
    }

    /**
     * Method that loops through all orders in cart and returns total cost
     * @return $total - Integer
     */
    function getTotal()
    {
        $total = 0;
         foreach ($this->_cart as $order) {

            $total +=  $order['prod']->getPrice() * $order['qty'];
        }

         return $total;
    }

    /**
     * Method that loops through all products in cart and returns total amount of items in cart
     * @return $total - Integer
     */
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