<?php

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die;
class Api extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('security');
        $this->security->security_test('client');
    }

    function get_auth_1() {

        $url = "https://devapi.currencycloud.com/v2/authenticate/api";
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => 0,
            CURLOPT_POSTFIELDS => [
                'login_id' => 'iradra@mta.ac.il',
                'api_key' => 'c3355e7a58cceaa964baa867e7b5db23dd8f3a9129aac698ccaf93c247e2613b'
            ]
        ]);
        $output = curl_exec($curl);
        $auth = json_decode($output)->auth_token;
        curl_close($curl);
        return $auth;
    }

    function get_balance_1() {
        $auth = $this->get_auth_1();
        $url = "https://devapi.currencycloud.com/v2/balances/find";
        $curl = curl_init();
        $headers = array("X-Auth-Token: $auth");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($curl);
        $info = curl_getinfo($curl);

        curl_close($curl);

        echo '<pre>';
        print_r($output);
        echo '</pre>';
    }

//https://devapi.currencycloud.com/v2/rates/find?currency_pair=GBPUSD
//curl -X GET https://devapi.currencycloud.com/v2/rates/detailed?
//      $url = sprintf("%s?%s", $url, http_build_query($data));
    function get_rate_1($currency1, $currency2) {
        $pair = strtoupper($currency1 . $currency2);
        $auth = $this->get_auth_1();
        $url = "https://devapi.currencycloud.com/v2/rates/find?currency_pair=$pair";
        $curl = curl_init();

        $headers = array(
            "X-Auth-Token: $auth",
            'Content-Type: application/json'
        );
        $data = array('currency_pair' => 'GBPUSD');
        $data_string = json_encode($data);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $output = curl_exec($curl);

        curl_close($curl);
//        echo '<pre>';
//        print_r($output);
//        echo '</pre>';
        return $output;
    }

    //curl -X POST -d "buy_currency=GBP&sell_currency=USD&fixed_side=BUY&amount=100&term_agreement=1" --header "X-Auth-Token: XXXX-XXXXX-XXXX"  https://devapi.currencycloud.com/v2/conversions/create
    function create_conversion_1() {
        $post_data = $this->input->post();
        $currency1 = strtoupper($post_data['currency1']);
        $currency2 = strtoupper($post_data['currency2']);

        $auth = $this->get_auth_1();
        $url = "https://devapi.currencycloud.com/v2/conversions/create";
        $curl = curl_init();

        $headers = array(
            "X-Auth-Token: $auth",
            'Content-Type: application/json'
        );
        $data = array('currency_pair' => 'GBPUSD');
        $data_string = json_encode($data);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $output = curl_exec($curl);

        curl_close($curl);
//        echo '<pre>';
//        print_r($output);
//        echo '</pre>';
        return $output;
    }

}
