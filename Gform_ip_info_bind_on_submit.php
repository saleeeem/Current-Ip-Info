<?php 

if( ! function_exists( 'wpe_get_IP' ) ) {
    /**
     * gets the current user IP address
     *
     * @since  1.7.4
     */
    function wpe_get_IP() {
        //whether ip is from the share internet
    
        if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
            $ip = filter_var( $_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP);
        } //whether ip is from the proxy
        elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            $ip = filter_var( $_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP);
        } //whether ip is from the remote address
        else {
            $ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
        }
        return $ip;
    }
}


add_filter( 'gform_field_value_country_name', 'user_country_update' );
function user_country_update( $value ) {
	
	$ip    = wpe_get_IP();
	$ipdat = @json_decode( file_get_contents( "http://ip-api.com/json/" . $ip ) );
	return $ipdat->country; 
	
	
}
add_filter( 'gform_field_value_city_name', 'user_city_update' );
function user_city_update( $value ) {
	
	$ip    = wpe_get_IP();
	$ipdat = @json_decode( file_get_contents( "http://ip-api.com/json/" . $ip ) );
	return $ipdat->city; 
}