<?php
class ModelModuleCallback extends Model {	
	public function addCallback($data) {
    	  	$query = $this->db->query("INSERT INTO " . DB_PREFIX . "callback SET name = '" . $data['name']  . "',
			callback_url = '" . $data['url_site']  . "',
			comment_buyer = '" . $data['comment_buyer']  . "',
			email_buyer = '" . $data['email_buyer']  . "',
			topic_callback_send = '" . $data['topic_callback_send']  . "',
			time_callback_on = '" . $data['time_callback_on']  . "',
			time_callback_off = '" . $data['time_callback_off']  . "',
			telephone = '" . $data['phone'] . "', date_added = NOW(),
			date_modified = NOW(), status_id = '0', comment = ''");
		
		return $this->db->getLastId();	
	}	
	public function license_key() {
		$query_key = $this->db->query("select `license_key` from `key` where `key`='local_key'");
		return $query_key->row['license_key'];
	}

	public function getSocial() {
		$social_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "social_table");
		
		foreach ($query->rows as $result) {
			$social_data[] = array(
				'social_id'        => $result['social_id'],
				'name'           => $result['name'],
				'image'           => $result['image'],
				
			);
		}
		return $social_data;
	}
	public function getCallbacktopic() {
		$call_topic_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "call_topic");
		
		foreach ($query->rows as $result) {
			$call_topic_data[] = array(
				'id'        => $result['id'],
				'name'           => $result['name'],
				
			);
		}
		return $call_topic_data;
	}	
}
?>
