<?php
/**
 * Validation Class for validating form data from the view pages.
 */
class Validation {

    /**
     * Function to validate first name
     * @param string $name User first name
     * @return boolean true if valid, false otherwise
     */
    function validFName($name): bool
    {
        return strlen($name) < 2;
    }

    /**
     * Function to validate last name
     * @param string $name User last name
     * @return boolean true if valid, false otherwise
     */
    function validLName($name): bool
    {
        return strlen($name) < 2;
    }

    /**
     * Function to validate email
     * @param string $email user entered email
     * @return boolean true if valid, false otherwise
     */
    function validEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Function to validate password for account creation
     * @param string $password new user password
     * @return boolean true if valid, false otherwise
     */
    function validPassword($password)
    {
        return strlen($password) < 8;
    }

    /**
     * Function to validate street
     * @param string $street user's street address
     * @return boolean true if valid, false otherwise
     */
    function validStreet($street)
    {
        return strlen($street) < 5;
    }

    /**
     * Function to validate city
     * @param string $city User's city address
     * @return boolean true if valid, false otherwise
     */
    function validCity($city)
    {
        return strlen($city) < 3;
    }

    /**
     * Method to check if passed state abbreviation is a key in the states map
     * from the data-layer.
     * @param $state String of two characters representing US state or territory
     * @return bool True if $state abbreviation is a key in states map, false
     * otherwise
     */
    static function validState($state) {
        return array_key_exists($state, DataLayer::getStatesMap());
    }

    /**
     * Function to validate zip
     * @param int $zip User's zipcode
     * @return boolean true if valid, false otherwise
     */
    function validZip($zip)
    {
        return $zip < 1;
    }

    /**
     * Function to validate card number
     * @param int $cardNum 16 digit card number
     * @return boolean true if valid, false otherwise
     */
    function validCardNum($cardNum)
    {
        return strlen((string)$cardNum) != 16;
    }

    /**
     * Function to validate expiration month
     * @param int $expMonth Month of card expiration
     * @return boolean true if valid, false otherwise
     */
    function validExpMonth($expMonth): bool
    {
        return $expMonth < 1 || $expMonth > 12;
    }

    /**
     * Function to validate expiration year
     * @param int $expYear Year of card expiration
     * @return boolean true if valid, false otherwise
     */
    function validExpYear($expYear): bool
    {
        return $expYear < 2022;
    }

    /**
     * Function to validate cvv
     * @param int $cvv Card CVV
     * @return boolean true if valid, false otherwise
     */
    function validCVV($cvv): bool
    {
        return $cvv < 100 || $cvv > 9999;
    }

    /**
     * Function to validate scent
     * @param string $setScent scent of diffuser oil to be validated
     * @return boolean true if valid, false otherwise
     */
    function validateScent($setScent)
    {
        $scents = $GLOBALS['datalayer']->getScents();

        foreach ($scents as $scent) {
            if ($scent == $setScent) {
                return true;
            }
        }

        return false;
    }
}
