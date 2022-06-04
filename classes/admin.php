<?php

class Admin
{
    private $_adminId;
    private $_email;


   function __construct($adminId, $email) {
        $this->_adminId = $adminId;
        $this->_email = $email;
   }

   function getAdminId() {
       return $this->_adminId;
   }

   function getAdminEmail() {
       return $this->_email;
   }

}