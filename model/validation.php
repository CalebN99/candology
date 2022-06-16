<?php
/**
 * Validation Class
 */
class Validation {

    /**
     * Function to validate first name
     * @return boolean
     */
    function validFName($name): bool
    {
        return strlen($name) < 2;
    }

    /**
     * Function to validate last name
     * @return boolean
     */
    function validLName($name): bool
    {
        return strlen($name) < 2;
    }

    /**
     * Function to validate email
     * @return boolean
     */
    function validEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Function to validate password
     * @return boolean
     */
    function validPassword($password) {
        return strlen($password) < 8;
    }

    /**
     * Function to validate street
     * @return boolean
     */
    function validStreet($street) {
        strlen($street) < 5;
    }

    /**
     * Function to validate city
     * @return boolean
     */
    function validCity($city) {
        return strlen($city) < 3;
    }

    /**
     * Function to validate zip
     * @return boolean
     */
    function validZip($zip) {
        return $zip < 1;
    }

    /**
     * Function to validate card number
     * @return boolean
     */
    function validCardNum($cardNum) {
        return strlen((string)$cardNum) != 16;
    }

    /**
     * Function to validate expiration month
     * @return boolean
     */
    function validExpMonth($expMonth) {
        return $expMonth < 1 || $expMonth > 12;
    }

    /**
     * Function to validate expiration year
     * @return boolean
     */
    function validExpYear($expYear) {
        return $expYear < 2022;
    }

    /**
     * Function to validate cvv
     * @return boolean
     */
    function validCVV($cvv) {
        return $cvv < 100 || $cvv > 9999;
    }

    /**
     * Function to validate scent
     * @return boolean
     */
    function validateScent($setScent) {
        $scents = $GLOBALS['datalayer']->getScents();

        foreach ($scents as $scent) {
            if ($scent == $setScent) {
                return true;
            }
        }

        return false;
    }
}
