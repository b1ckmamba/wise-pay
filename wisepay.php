<?php
/*
 * Wise Payment Gateway Module for WHMCS
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

require_once(dirname(__FILE__) . '/wisepay_config.php');
require_once(dirname(__FILE__) . '/wisepay_functions.php');
require_once(dirname(__FILE__) . '/wisepay_lang.php');

function wisepay_MetaData() {
    return array(
        'DisplayName' => 'Wise Payment Gateway',
        'APIVersion' => '1.1',
        'DisableLocalCreditCardInput' => true,
        'TokenisedStorage' => false,
    );
}

function wisepay_config() {
    return wisepay_getConfigOptions();
}

function wisepay_link($params) {
    $invoiceId = $params['invoiceid'];
    $description = wisepay_getInvoiceDescription($invoiceId);
    $amount = $params['amount'];
    $currencyCode = $params['currency'];
    $returnUrl = wisepay_getReturnUrl($params);

    $data = array(
        'amount' => $amount,
        'currency' => $currencyCode,
        'returnUrl' => $returnUrl,
        'description' => $description,
    );

    $response = wisepay_createPayment($data);

    if ($response && isset($response['transfer']['url'])) {
        $paymentUrl = $response['transfer']['url'];
        
        // Add the Wise logo to the payment form
        $gatewayLogo = '<img src="' . $params['modulelink'] . '/wise-logo.png" alt="Wise" style="margin-bottom: 10px;">';
        
        $code = $gatewayLogo . '<form action="' . $paymentUrl . '" method="post"><input type="submit" value="' . $params['langpaynow'] . '"></form>';
        return $code;
    } else {
        $errorMsg = isset($response['error']['message']) ? $response['error']['message'] : $params['langtransfailed'];
        return $errorMsg;
    }
}


?>
