<?php

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die;
class Currencies extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function get($order_by) {
        $this->load->model('mdl_currencies');
        $query = $this->mdl_currencies->get($order_by);
        return $query;
    }

    function get_rand($order_by) {
        $this->load->model('mdl_currencies');
        $query = $this->mdl_currencies->get_rand($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        $this->load->model('mdl_currencies');
        $query = $this->mdl_currencies->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        $this->load->model('mdl_currencies');
        $query = $this->mdl_currencies->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_currencies');
        $query = $this->mdl_currencies->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_currencies');
        $insert_id = $this->mdl_currencies->_insert($data);

        return $insert_id;
    }

    function _update($id, $data) {
        $this->load->model('mdl_currencies');
        $this->mdl_currencies->_update($id, $data);
    }

    function _delete($id) {
        $this->load->model('mdl_currencies');
        $this->mdl_currencies->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_currencies');
        $count = $this->mdl_currencies->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_currencies');
        $max_id = $this->mdl_currencies->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_currencies');
        $query = $this->mdl_currencies->_custom_query($mysql_query);
        return $query;
    }

}
