<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model('user_model');
	}

	public function index() {

		$data['title'] = "Admin Login";

		$this -> load -> view('common_files/header', $data);
		$this -> load -> view('admin_login');
		$this -> load -> view('common_files/footer');
	}

	public function login() {

		$this -> form_validation -> set_rules('admin_username', 'Username', 'trim|required|valid_email|xss_clean');
		$this -> form_validation -> set_rules('admin_password', 'Password', 'trim|required|xss_clean');
		if ($this -> form_validation -> run() == FALSE) {
			$data['title'] = "Admin Login";
			$this -> load -> view('common_files/header', $data);
			$this -> load -> view('admin_login', $data);
			$this -> load -> view('common_files/footer');
		} else {
			if ($this -> user_model -> UserLogin(1)) {
				if ($this -> session -> userdata('admin_logged_in')) {
					redirect('category');

				}
			} else {
				$data['title'] = "Admin Login";
				$data['admin_username'] = "Admin Login";
				$this -> session -> set_flashdata('errormessage', 'Email/ Password does not match');
				redirect('admin');

			}
		}

	}

	public function logout() {
		$admindata = array('admin_email' => '', 'admin_id' => '', 'admin_logged_in' => FALSE);
		$this -> session -> set_userdata($admindata);
		redirect('admin');
	}

}
