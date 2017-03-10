<?php
/*
 Plugin Name: GW WPChats Integrations
 Plugin URI: 
 Description: Adds messaging buttons to profiles.
 Author: GippslandWeb
 Version: 1.0.2
 Author URI: https://gippslandweb.com.au
 GitHub Plugin URI: Gippsland-Web/gw-bp-wpc-integration
 */

 class GW_WPCIntegration {
     public function __construct() {
        add_action('bp_member_header_actions',array($this,'display_msg_button') );
    }

//Display Member type in the Profile header
function display_msg_button() {
if(!is_user_logged_in())
    return;
    if(get_current_user_id() != bp_displayed_user_id())
        echo('<div class="message-button  generic-button" id="message-button"><a href="/wpc-messages/'.bp_core_get_username(bp_displayed_user_id()).'/">Send Message</a></div>');
    else
        {
            $cnt = $this->unread_counter(get_current_user_id());
            if($cnt > 0)
                echo('<div class="message-button  generic-button" id="message-button"><a href="/wpc-messages/">'.$cnt.' New Message</a></div>');
            else
                    echo('<div class="message-button  generic-button" id="message-button"><a href="/wpc-messages/">View Message</a></div>');

        }
    
  // $this->se_start_chat_btn_by_user(bp_displayed_user_id());
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









