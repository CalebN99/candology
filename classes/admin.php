<?php

// Admin class
class Admin
{
    private $_adminId;
    private $_email;

    /**
     * Constructor method for Admin class
     * @return void
     */
   function __construct($adminId, $email) {
        $this->_adminId = $adminId;
        $this->_email = $email;
   }

    /**
     * Method to return $_adminId Variable
     * @return $_adminId
     */
   function getAdminId() {
       return $this->_adminId;
   }


    /**
     * Method to return $_email variable
     * @return $_email
     */
   function getAdminEmail() {
       return $this->_email;
   }

}