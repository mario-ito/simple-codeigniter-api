<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * API Contacts
 */
class Contacts extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('Contacts_model');
	}

	
	function output_json($output) {
		if (!is_array($output)) {
			$output = array(
				'status' => 'false',
				'message' => 'Formating error',
				'data' => '',
			);
		}
		echo json_encode($output);
	}

	
	function index() {
		$list = $this->Contacts_model->db_list();
		$this->output_json($list);
	}


	function get($id = null) {

		if (!filter_var($id, FILTER_VALIDATE_INT)) {
			$output = array(
				'status' => 'false',
				'message' => 'ID is required to get contact',
				'data' => '',
			);
		} else {
			$contact = $this->Contacts_model->db_get($id);
			if (isset($contact['name'])) {
				$output = array(
					'status' => 'true',
					'message' => 'Contact found',
					'data' => $contact,
				);
			} else {
				$output = array(
					'status' => 'false',
					'message' => 'Contact not found',
					'data' => '',
				);
			}
		}

		$this->output_json($output);

	}


	function add() {

		$post_array = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'telephone' => $this->input->post('telephone'),
			'address' => $this->input->post('address'),
			'facebook' => $this->input->post('facebook'),
		);

		// Contact name is required
		if ($post_array['name'] != '') {

			$insert = $this->Contacts_model->db_add($this->input->post());
			if ($insert > 0) {
				$output = array(
					'status' => 'true',
					'message' => 'Contact added',
					'data' => $insert,
				);
			} else {
				$output = array(
					'status' => 'false',
					'message' => 'Error inserting contact',
					'data' => '',
				);
			}
	
		} else {
	
			$output = array(
				'status' => 'false',
				'message' => 'Contact name is required',
				'data' => '',
			);
	
		}

		$this->output_json($output);

	}


	function edit($id = null) {

		$post_array = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'telephone' => $this->input->post('telephone'),
			'address' => $this->input->post('address'),
			'facebook' => $this->input->post('facebook'),
		);

		if (!filter_var($id, FILTER_VALIDATE_INT)) {
			$output = array(
				'status' => 'false',
				'message' => 'ID is required to update contact',
				'data' => '',
			);
		} else if ($post_array['name'] == '') {
			$output = array(
				'status' => 'false',
				'message' => 'Contact name is required',
				'data' => '',
			);	
		} else {
			$update = $this->Contacts_model->db_update($this->input->post(), $id);
			if ($update > 0) {
				$output = array(
					'status' => 'true',
					'message' => 'Contact updated',
					'data' => $update,
				);
			} else {
				$output = array(
					'status' => 'false',
					'message' => 'Error updating contact',
					'data' => '',
				);
			}
		}

		$this->output_json($output);

	}


	function delete($id = null) {

		if (!filter_var($id, FILTER_VALIDATE_INT)) {
			$output = array(
				'status' => 'false',
				'message' => 'ID is required to delete contact',
				'data' => '',
			);
		} else {
			$delete = $this->Contacts_model->db_delete($id);
			if ($delete > 0) {
				$output = array(
					'status' => 'true',
					'message' => 'Contact deleted',
					'data' => $delete,
				);
			} else {
				$output = array(
					'status' => 'false',
					'message' => 'Error deleting contact',
					'data' => '',
				);
			}
		}

		$this->output_json($output);

	}


}