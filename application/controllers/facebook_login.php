<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Facebook_Login extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// To use site_url and redirect on this controller.
		$this -> load -> model('user_model');
	}

	public function login() {
		$this -> load -> library('facebook');
		$user = $this -> facebook -> getUser();

		if ($user) {
			try {
				$data['user_profile'] = $this -> facebook -> api('/me');
				$this -> user_model -> fconnect($data['user_profile']);
			} catch (FacebookApiException $e) {
				$user = null;
			}
		} else {
			$this -> facebook -> destroySession();
		}

		if ($user) {

			$data['logout_url'] = site_url('facebook_login/logout');
			// Logs off application
			// OR
			// Logs off FB!
			// $data['logout_url'] = $this->facebook->getLogoutUrl();

		} else {
			$data['login_url'] = $this -> facebook -> getLoginUrl(array('redirect_uri' => site_url('facebook_login/login'), 'scope' => array("email") // permissions here
			));
			redirect($data['login_url']);
		}
		/*$data['title']="Fb login";
		 $this -> load -> view('common_files/header', $data);
		 $this -> load -> view('flogin', $data);
		 $this -> load -> view('common_files/footer', $data);*/

	}

	public function logout() {

		// Logs off session from website
		$this -> facebook -> destroySession();
		// Make sure you destory website session as well.

		redirect('user');
	}

}
