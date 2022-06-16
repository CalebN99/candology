<?php

// Script to update a product quantity in the database

// Error Reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);



$qty = $_POST['qty'];
$id = $_POST['productId'];

// Validate quantity
if ($qty < 0) {
    echo '<div class="toast-header">
          <strong class="mr-auto text-danger">Error</strong>
      </div>
      <div class="toast-body">Invalid Quantity</div>';
}
// Validate Product ID
else if($GLOBALS['datalayer']->getProduct($id) == false) {
    echo '<div class="toast-header">
          <strong class="mr-auto text-danger">Error</strong>
      </div>
      <div class="toast-body">Product ID Not Recognized</div>';
}
else {
    // Change product quantity in database
    $GLOBALS['datalayer']->setQuantity($id, $qty);

    echo '<div class="toast-header">
          <strong class="mr-auto text-success">Success</strong>
      </div>
      <div class="toast-body">Quantity Updated!</div>';
}