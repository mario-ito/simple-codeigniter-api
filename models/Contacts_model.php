<?php 
/**
* Database operations for the Contacts controller
*/

class Contacts_model extends CI_Model {
	
	function __construct() {	
		$this->load->database();
	}

	function db_list() {
		return $this->db->select('id, name, email, telephone, address, facebook')->get_where('contacts', array('active' => '1'))->result_array();
	}

	function db_get($id) {
		return $this->db->select('id, name, email, telephone, address, facebook')->get_where('contacts', array('id' => $id, 'active' => '1'))->row_array();
	}

	function db_add($post_array) {
		return $this->db->insert('contacts', $post_array);
	}

	function db_update($post_array, $id) {
		if (isset($post_array['id'])) {
			unset($post_array['id']);
		}
		return $this->db->update('contacts', $post_array, array('id' => $id));
	}

	function db_delete($id) {
		return $this->db->update('contacts', array('active' => '0'), array('id' => $id));
	}

}