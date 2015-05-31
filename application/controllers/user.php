<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model('user_model');
	}

	public function index() {

		$data['title'] = "User";

		// Automatically picks appId and secret from config
		//  OR
		//  You can pass different one like this

		$this -> load -> view('common_files/header', $data);
		$this -> load -> view('common_files/navbar_blogin', $data);
		$this -> load -> view('user_view');
		$this -> load -> view('common_files/footer');
	}

	public function login() {

		$this -> form_validation -> set_rules('username', 'Username', 'trim|required|valid_email|xss_clean');
		$this -> form_validation -> set_rules('password', 'Password', 'trim|required|xss_clean');
		if ($this -> form_validation -> run() == FALSE) {
			$data['title'] = "User";
			$this -> load -> view('common_files/header', $data);
			$this -> load -> view('user_view', $data);
			$this -> load -> view('common_files/footer');
		} else {
			if ($this -> user_model -> UserLogin(0)) {
				if ($this -> session -> userdata('user_logged_in')) {
					redirect('product_list');

				}
			} else {
				$data['title'] = "user";

				$this -> session -> set_flashdata('errormessage', 'Email/ Password does not match');
				redirect('user');

			}
		}

	}

	public function registration() {
		$data['title'] = "User Registration";

		$this -> load -> view('common_files/header', $data);
		$this -> load -> view('common_files/navbar_blogin', $data);
		$this -> load -> view('user_register');
		$this -> load -> view('common_files/footer');
	}

	public function register() {
		$this -> form_validation -> set_rules('username', 'Username', 'trim|required|valid_email|xss_clean|is_unique[users.user_email]');
		$this -> form_validation -> set_rules('password', 'Password', 'trim|required|xss_clean|matches[confirmpassword]');
		$this -> form_validation -> set_rules('confirmpassword', 'Confirm password', 'trim|required|xss_clean');
		if ($this -> form_validation -> run() == FALSE) {
			$data['title'] = "User Registration";
			$this -> load -> view('common_files/header', $data);
			$this -> load -> view('user_register', $data);
			$this -> load -> view('common_files/footer');
		} else {
			if ($this -> user_model -> userRegister()) {
				$this -> session -> set_flashdata('errormessage', 'Registration Successful,Please login to Continue');
				redirect('user/registration');

			} else {
				$this -> session -> set_flashdata('errormessage', 'Registration failed,Please try again later');
				redirect('user/registration');
			}
		}
	}

	public function logout() {
		$admindata = array('admin_email' => '', 'admin_id' => '', 'admin_logged_in' => FALSE);
		$this -> session -> set_userdata($admindata);
		redirect('admin');
	}

	public function user_logout() {
		$userdata = array('user_email' => '', 'user_id' => '', 'user_logged_in' => FALSE);
		$this -> session -> set_userdata($userdata);
		redirect('facebook_login/logout');
		redirect('user');
	}

}
