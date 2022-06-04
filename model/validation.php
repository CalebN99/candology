<?php

function validFName($name): bool
{
    return strlen($name) < 2;
}

function validLName($name): bool
{
    return strlen($name) < 2;
}

function validEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validPassword($password) {
   return strlen($password) < 8;
}

function validStreet($street) {
    strlen($street) < 5;
}

function validCity($city) {
    return strlen($city) < 3;
}

function validZip($zip) {
    return $zip < 1;
}

function validCardNum($cardNum) {
    return strlen((string)$cardNum) != 16;
}

function validExpMonth($expMonth) {
    return $expMonth < 1 || $expMonth > 12;
}

function validExpYear($expYear) {
    return $expYear < 2022;
}

function validCVV($cvv) {
    return $cvv < 100 || $cvv > 9999;
}