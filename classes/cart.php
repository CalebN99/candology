<?php

/**
 * Cart Objects store the user's products and their quantities. The cart can
 * get the total price of the items in the cart and the number of items stored.
 */
class Cart
{
    private $_cart;

    /**
     * Checks if products exists then adds it to our $_cart variable
     *
     * @param int $id Product ID
     * @param int $qty Number of product to add to cart
     * @param string|NULL $scent selected scent for diffuser products,
     * null for candles
     * @return void
     */
    function addProduct($id, $qty, $scent=NULL)
    {
        // Get product from database using ID
        $prod = $GLOBALS['datalayer']->getProduct($id);

        // Add selected scent for diffusers
        if($prod instanceof Diffuser) {
            $prod->setScent($scent);
        }

        // Store product in cart
        $this->_cart[] = ["prod"=>$prod, "qty"=>$qty];
    }

    /**
     * Method to return $_cart variable
     * @return array products in the cart mapped to their quantities.
     */
    function getCart()
    {
        return $this->_cart;
    }

    /**
     * Method that loops through all orders in cart and returns total cost
     * @return float total price of all items in cart
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
     * @return int number of products in the cart
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