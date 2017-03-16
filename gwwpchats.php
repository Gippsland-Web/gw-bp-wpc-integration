<?php
/*
 Plugin Name: GW WPChats Integrations
 Plugin URI: 
 Description: Adds messaging buttons to profiles.
 Author: GippslandWeb
 Version: 1.0.3
 Author URI: https://gippslandweb.com.au
 GitHub Plugin URI: Gippsland-Web/gw-bp-wpc-integration
 */

 class GW_WPCIntegration {
     public function __construct() {
        add_action('bp_profile_header_meta',array($this,'display_msg_button') );
    }

//Display Member type in the Profile header
function display_msg_button() {
if(!is_user_logged_in())
    return;
    if(get_current_user_id() != bp_displayed_user_id())
        echo('<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_0"><a class="messagebtn et_pb_button  et_pb_button_0 et_pb_module et_pb_bg_layout_light" href="/wpc-messages/'.bp_core_get_username(bp_displayed_user_id()).'/">Send Message</a></div>');
    else
        {
            $cnt = $this->unread_counter(get_current_user_id());
            if($cnt > 0)
                echo('<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_0"><a class="messagebtn et_pb_button  et_pb_button_0 et_pb_module et_pb_bg_layout_light" href="/wpc-messages/">'.$cnt.' New Message</a></div>');
            else
                    echo('<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_0"><a class="messagebtn et_pb_button  et_pb_button_0 et_pb_module et_pb_bg_layout_light" href="/wpc-messages/">View Message</a></div>');

        }
    
}







function unread_counter($user_id=0) {
	if ( !$user_id ) {
		$user_id = get_current_user_id();
	}
	if ( !$user_id ) return 0;
	$unreads = wpc_user_unreads_noajax( $user_id );
	$counter = array();
	if ( $unreads ) {
		foreach ( (array) $unreads as $data ) {
			if ( !isset( $counter[ $data['pm_id'] ] ) ) {
				$counter[ $data['pm_id'] ] = 1;
			}
		}
	}
	return count($counter);
}




 }

 $gwWPCIntegration = new \GW_WPCIntegration();









