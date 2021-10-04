<?php

namespace App\Lib;


class CoinPayments
{
    private $private_key = '';
    private $public_key = '';
    private $ch = null;

    public function Setup($private_key, $public_key) {
        $this->private_key = $private_key;
        $this->public_key = $public_key;
        $this->ch = null;
    }

    /**
     * Gets the current CoinPayments.net exchange rate. Output includes both crypto and fiat currencies.
     * @param bool $short
     * @return array|mixed
     */
    public function GetRates($short = TRUE) {
        $short = $short ? 1:0;
        return $this->api_call('rates', array('short' => $short));
    }

    /**
     * Gets your current coin balances (only includes coins with a balance unless all = TRUE).<br />
     * @param bool $all
     * @return array|mixed
     */
    public function GetBalances($all = FALSE) {
        return $this->api_call('balances', array('all' => $all ? 1:0));
    }

    /**
     * Creates a basic transaction with minimal parameters.<br />
     * See CreateTransaction for more advanced features.
     * @param $amount
     * @param $currency1
     * @param $currency2
     * @param $buyer_email
     * @param string $address
     * @param string $ipn_url
     * @return array|mixed
     */
    public function CreateTransactionSimple($amount, $currency1, $currency2, $buyer_email, $address='', $ipn_url='') {
        $req = array(
            'amount' => $amount,
            'currency1' => $currency1,
            'currency2' => $currency2,
            'buyer_email' => $buyer_email,
            'address' => $address,
            'ipn_url' => $ipn_url,
        );
        return $this->api_call('create_transaction', $req);
    }

    public function CreateTransaction($req) {
        // See https://www.coinpayments.net/apidoc-create-transaction for parameters
        return $this->api_call('create_transaction', $req);
    }

    /**
     * Creates an address for receiving payments into your CoinPayments Wallet.<br />
     * @param currency The cryptocurrency to create a receiving address for.
     * @param string $ipn_url
     * @return array|mixed
     */
    public function GetCallbackAddress($currency, $ipn_url = '') {
        $req = array(
            'currency' => $currency,
            'ipn_url' => $ipn_url,
        );
        return $this->api_call('get_callback_address', $req);
    }

    /**
     * Creates a withdrawal from your account to a specified address.<br />
     * @param $amount
     * @param $currency
     * @param $address
     * @param bool $auto_confirm
     * @param string $ipn_url
     * @return array|mixed
     */
    public function CreateWithdrawal($amount, $currency, $address, $auto_confirm = FALSE, $ipn_url = '') {
        $req = array(
            'amount' => $amount,
            'currency' => $currency,
            'address' => $address,
            'auto_confirm' => $auto_confirm ? 1:0,
            'ipn_url' => $ipn_url,
        );
        return $this->api_call('create_withdrawal', $req);
    }

    /**
     * Creates a transfer from your account to a specified merchant.<br />
     * @param $amount
     * @param $currency
     * @param $merchant
     * @param bool $auto_confirm
     * @return array|mixed
     */
    public function CreateTransfer($amount, $currency, $merchant, $auto_confirm = FALSE) {
        $req = array(
            'amount' => $amount,
            'currency' => $currency,
            'merchant' => $merchant,
            'auto_confirm' => $auto_confirm ? 1:0,
        );
        return $this->api_call('create_transfer', $req);
    }

    /**
     * Creates a transfer from your account to a specified $PayByName tag.<br />
     * @param $amount
     * @param $currency
     * @param $pbntag
     * @param bool $auto_confirm
     * @return array|mixed
     */
    public function SendToPayByName($amount, $currency, $pbntag, $auto_confirm = FALSE) {
        $req = array(
            'amount' => $amount,
            'currency' => $currency,
            'pbntag' => $pbntag,
            'auto_confirm' => $auto_confirm ? 1:0,
        );
        return $this->api_call('create_transfer', $req);
    }

    private function is_setup() {
        return (!empty($this->private_key) && !empty($this->public_key));
    }

    private function api_call($cmd, $req = array()) {
        if (!$this->is_setup()) {
            return array('error' => 'You have not called the Setup function with your private and public keys!');
        }

        // Set the API command and required fields
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['key'] = $this->public_key;
        $req['format'] = 'json'; //supported values are json and xml

        // Generate the query string
        $post_data = http_build_query($req, '', '&');

        // Calculate the HMAC signature on the POST data
        $hmac = hash_hmac('sha512', $post_data, $this->private_key);

        // Create cURL handle and initialize (if needed)
        if ($this->ch === null) {
            $this->ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($this->ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac));
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post_data);

        $data = curl_exec($this->ch);
        if ($data !== FALSE) {
            if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
                // We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
                $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
            } else {
                $dec = json_decode($data, TRUE);
            }
            if ($dec !== NULL && count($dec)) {
                return $dec;
            } else {
                // If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
                return array('error' => 'Unable to parse JSON result ('.json_last_error().')');
            }
        } else {
            return array('error' => 'cURL error: '.curl_error($this->ch));
        }
    }


}
