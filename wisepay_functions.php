<?php
/*
 * Wise Payment Gateway Module for WHMCS
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function wisepay_getInvoiceDescription($invoiceId) {
    // Get the invoice details from the database
    $result = select_query('tblinvoices', 'id', array('id' => $invoiceId));
    $data = mysql_fetch_array($result);

    if ($data && isset($data['id'])) {
        // Build the invoice description
        $invoiceNumber = $data['id'];
        $invoiceDescription = 'Invoice #' .
