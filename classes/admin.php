<?php

/**
 * Admin is a sudo user object used in place of the User class, without the
 * extra account details. Stores just the userID and Admin username.
 */
class Admin
{
    private int $_adminId;
    private string $_email;

    /**
     * Constructor method for Admin class
     * @param int $adminId userID of admin account
     * @param String $email Username of the admin
     * @return void
     */
   function __construct($adminId, $email)
   {
        $this->_adminId = $adminId;
        $this->_email = $email;
   }

    /**
     * Method to return $_adminId Variable
     * @return int admin userID
     */
   function getAdminId(): int
   {
       return $this->_adminId;
   }


    /**
     * Method to return $_email variable
     * @return string admin username
     */
   function getAdminEmail(): string
   {
       return $this->_email;
   }

}