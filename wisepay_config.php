<?php
/*
 * Wise Payment Gateway Module for WHMCS
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function wisepay_getConfigOptions() {
    $configarray = array(
        'FriendlyName' => array(
            'Type' => 'System',
            'Value' => 'Wise Payment Gateway',
        ),
        'accountId' => array(
            'FriendlyName' => 'Account ID',
            'Type' => 'text',
            'Size' => '30',
            'Default' => '',
            'Description' => 'Enter your Wise account ID here',
        ),
        'apiKey' => array(
            'FriendlyName' => 'API Key',
            'Type' => 'password',
            'Size' => '30',
            'Default' => '',
            'Description' => 'Enter your Wise API key here',
        ),
    );

    return $configarray;
}

?>
