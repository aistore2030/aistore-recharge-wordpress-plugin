<?php
 

//http://www.aistore2030.com/wp-json/aistoreRecharge/v1/AcceptCallback/?txid=730512

add_action('rest_api_init', function () {
    register_rest_route('aistoreRecharge/v1', '/AcceptCallback', array(
        'methods' => 'GET',
        'callback' => 'aistoreRecharge_secure_callback_accept_func',
    ));
});

function aistoreRecharge_secure_callback_accept_func(WP_REST_Request $data) {

    $insert_id = $data['txid'];

    $url = "http://api.sakshamapp.com/Status?username=" . esc_attr(get_option('aistore_username')) . "&password=" . esc_attr(get_option('aistore_password')) . "&txid=" . $insert_id . "&format=json";


    $response = wp_remote_get($url);



    $ar = json_decode($response['body']);



    global $wpdb;
    $table_name = $wpdb->prefix . 'recharge';

    $wpdb->query($wpdb->prepare("update $table_name 
 set  status  = %s,
 status_url  = %s,
 status_response  = %s,
 operator_transaction_id= %s
 where  id  = %d   
  ", array(
                $ar->Status,
                $url,
                $response['body'],
                $ar->op_txid,
                $insert_id
    )));




    return $data['txid'];
}
