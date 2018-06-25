<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
 
/*
* A PHP Function which checks if the IP Address specified is a Proxy Server utilising the API provided by https://proxycheck.io
* This function is covered under an MIT License.
*/
function proxycheck_function($Visitor_IP, $ASN_Check) {
 
    $pvb_Transient_Exploded = explode( "-", get_transient(  "pvb_" . $Visitor_IP ) );
    if ( $pvb_Transient_Exploded[0] == false ) {
        $pvb_Transient_Exploded[0] = 0;
    }
   
    if ( time() >= $pvb_Transient_Exploded[0] ) {
        // Current time has surpassed the time we set for expirary if it existed already.
        // That means we need to check this IP with the API.
       
        // Setup the correct querying string for the transport security selected.
        if ( get_option('pvb_proxycheckio_TLS_select_box') == "on") {
            $Transport_Type_String = "https://";
        } else {
            $Transport_Type_String = "http://";
        }
 
        // Applying TAG options
        if ( get_option('pvb_proxycheckio_TAG_select_box') == "") {
            $Post_Field = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        } else if ( get_option('pvb_proxycheckio_TAG_select_box') == "on") {
            $Post_Field = get_option('pvb_proxycheckio_Custom_TAG_field');
        } else {
            $Post_Field = "";
        }
        // Performing the API query to proxycheck.io/v2/ using WordPress HTTP API
        $body = array(
            'tag' => $Post_Field
        );
     
        global $wp_version;
        $args = array(
            'body' => $body,
            'timeout' => '5',
            'httpversion' => '1.1',
            'blocking' => true,
            'user-agent' => 'PVB/' . get_option('proxy_vpn_blocker_version') . '; WordPress/' . $wp_version . '; ' . home_url(),
            'headers' => array(),
            'cookies' => array()
        );
   
        //get checkbox value for VPN_Option
        if ( get_option('pvb_proxycheckio_VPN_select_box') == "on") {
            $VPN_Option = 1;
        } else if ( get_option('pvb_proxycheckio_VPN_select_box') == "") {
            $VPN_Option = 0;
        }
   
        // Perform the query
        $response = wp_remote_post($Transport_Type_String . 'proxycheck.io/v2/' . $Visitor_IP . '?key=' . get_option('pvb_proxycheckio_API_Key_field') . '&vpn=' . $VPN_Option . '&days=' . get_option('pvb_proxycheckio_Days_Selector') . '&asn=' . $ASN_Check, $args );
     
        // Decode the JSON from proxycheck.io API
        $Decoded_JSON = json_decode(wp_remote_retrieve_body( $response ));
        // Check if the IP we're testing is a proxy server
        if ( $Decoded_JSON->$Visitor_IP->proxy == "yes" ) {
            // A proxy has been detected, return true and don't cache this.
            if ( $ASN_Check == 1 ) {
              $array = array("1", $Decoded_JSON->$Visitor_IP->country);
            } else {
              $array = array("1", "null");
            }
            return $array;
        } else {
            if ( $ASN_Check == 1 ) {
              $array = array("0", $Decoded_JSON->$Visitor_IP->country);
            } else {
              $array = array("0", "null");
            }
            return $array;
        }
    }  else {
        if ($pvb_Transient_Exploded[1] = "0") {
          $array = array("1", "null");
          return $array;
        } else {
          $array = array("0", "null");
          return $array;
        }
    }
}
?>