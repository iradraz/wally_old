<?php

class Client extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('security');
        $this->load->module('user');
        $this->load->module('transactions');
    }

    function feedback_post() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        $this->form_validation->set_rules('feedback_text', 'Feedback Text', 'required|max_length[300]');
        $post_data = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            $this->feedback();
        } else {
            $data = array(
                'user_id' => $session_data['user_id'],
                'feedback_text' => $post_data['feedback_text'],
            );
            $this->load->module('feedback');
            $this->feedback->_insert($data);
            redirect(base_url('/home/'));
        }
    }

    function subscribe() {
        //  echo 'thank you!';
        $this->load->view('client/thank_you_v');
    }

    function feedback() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        $data['content_view'] = 'client/feedback_v';
        $this->templates->client($data);
    }

    function wallet() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        $data['user_data'] = $this->user->get_where_custom('user_id', $session_data['user_id'])->result_array();
        $data['transactions'] = $this->transactions->get_where_custom('user_id', $session_data['user_id'])->result_array();
//                echo '<pre>';
//        print_r($data['transactions']);
//        echo '</pre>';
//        die;
        $data['content_view'] = 'client/wallet_v';
        $this->templates->client($data);
    }

    function exchange() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        
        $data['content_view'] = 'client/start_exchange_v';
        $this->templates->client($data);
    }

    function withdraw() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        echo 'withdraw page will come here';
    }

    function deposit() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        $post_data = $this->input->post();
        if ($post_data == null) {
            $data['content_view'] = 'client/add_funds_step_1_v';
            $this->templates->client($data);
        } else {
            $this->form_validation->set_rules('amount', 'Amount', 'required|greater_than[0]|numeric|');
            $this->form_validation->set_rules('currency', 'Currency', 'required|greater_than[0]|numeric|');


            $data['post_data'] = $post_data;
            $session_data = $this->session->userdata();
            //  if ($session_data['user_role'] == 'client') {
            $data['content_view'] = 'client/add_funds_step_2_v';
            $this->templates->client($data);
        }
    }

    function settings() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        echo 'settings page will come here';
    }

    function use_curl2() {

        $url = "https://api.sandbox.transferwise.tech/v1/profiles";

        $curl = curl_init();
        $headers = [
            "Authorization: Bearer 140bef54-a3c6-4fb5-ad43-4a07cc1a8700"
        ];
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => 0,
            //CURLOPT_USERPWD => "111111:140bef54-a3c6-4fb5-ad43-4a07cc1a8700",
            CURLOPT_HTTPHEADER => $headers
        ]);
// Send the request & save response to $resp
        $resp = curl_exec($curl);
// Close request to clear up some resources
        curl_close($curl);
        // echo '<pre>';
        print_r($resp);
        //  echo '</pre>';
        //  curl_close($ch);
    }

    function transaction() {
        $this->security->security_test('client');

        $session_data = $this->session->userdata();
        $post_data = $this->input->post();
        if ($post_data['submit'] == 'back') {
            $data['content_view'] = 'client/add_funds_step_1_v';
            $this->templates->client($data);
        } else if ($post_data['submit'] == 'submit') {
            $this->load->module('user');
            $user_data = $this->user->get_where_custom('user_id', $session_data['user_id'])->result_array();
            $current_status = $user_data[0]['user_' . strtolower($post_data['currency'])];
            $this->user->_update($session_data['user_id'], array('user_' . strtolower($post_data['currency']) => $current_status + $post_data['amount']));
            $data['content_view'] = 'client/transaction_success_v';
            $data['amount'] = $post_data['amount'];
            $data['currency'] = $post_data['currency'];
            //add here insertion into log table, and add jquery ajax call in the admin review table
            $this->transactions->_insert(
                    array(
                        'user_id' => $session_data['user_id'],
                        'currency' => $data['currency'],
                        'amount' => $data['amount']
                    )
            );
            $this->templates->client($data);
        }
        /*
          credit card info into database if I will decide to integrate with API
          $credit_card= $post_data['credit_card'];
          $cvv=$post_data['cvv'];
          $currency=$post_data['currency'];
          $amount=$post_data['amount'];
         */
    }

    function get($order_by) {
        $this->load->model('mdl_client');
        $query = $this->mdl_test->get($order_by);
        return $query;
    }

    function get_rand($order_by) {
        $this->load->model('mdl_client');
        $query = $this->mdl_test->get_rand($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        $this->load->model('mdl_client');
        $query = $this->mdl_test->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        $this->load->model('mdl_client');
        $query = $this->mdl_test->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_client');
        $query = $this->mdl_test->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_client');
        $insert_id = $this->mdl_test->_insert($data);

        return $insert_id;
    }

    function _update($id, $data) {
        $this->load->model('mdl_client');
        $this->mdl_test->_update($id, $data);
    }

    function _delete($id) {
        $this->load->model('mdl_client');
        $this->mdl_test->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_client');
        $count = $this->mdl_test->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_client');
        $max_id = $this->mdl_test->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_client');
        $query = $this->mdl_test->_custom_query($mysql_query);
        return $query;
    }

}
