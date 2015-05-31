<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/* File Name : user_model.php
 * Author:Karthick Kumar
 * Description: handle users registration and login
 * Created Date:30-05-2015
 * Modified Date:31-05-2015
 */
class User_Model extends CI_Model {

	public function UserLogin($isAdmin = 0) {
		if ($isAdmin == 1) {
			$email = $this -> input -> post('admin_username');
			$password = md5($this -> input -> post('admin_password'));
			$status = 1;
			$query = $this -> db -> get_where('users', array('user_email' => $email, 'user_password' => $password, 'user_type' => 1, 'user_status' => $status));

			if ($query -> num_rows() == 1) {
				$queryresult = $query -> row();
				$admindata = array('admin_email' => $queryresult -> user_email, 'admin_id' => $queryresult -> user_id, 'admin_logged_in' => TRUE);
				$this -> session -> set_userdata($admindata);
				return TRUE;

			} else {
				return FALSE;
			}
		} else {
			$email = $this -> input -> post('username');
			$password = md5($this -> input -> post('password'));
			$status = 1;
			$fb = 0;
			$query = $this -> db -> get_where('users', array('user_email' => $email, 'user_password' => $password, 'user_type' => 0, 'user_status' => $status, 'facebook_user' => $fb));

			if ($query -> num_rows() == 1) {
				$queryresult = $query -> row();
				$userdata = array('user_email' => $queryresult -> user_email, 'user_id' => $queryresult -> user_id, 'user_logged_in' => TRUE);
				$this -> cart -> destroy();
				$this -> session -> set_userdata($userdata);
				return TRUE;
			} else {
				return FALSE;
			}
		}

	}

	public function userRegister() {
		$email = $this -> input -> post('username');
		$password = md5($this -> input -> post('password'));
		$status = 1;
		$type = 0;
		$fb = 0;
		if ($this -> db -> insert('users', array('user_email' => $email, 'user_password' => $password, 'user_type' => $type, 'user_status' => $status, 'facebook_user' => $fb))) {
			return TRUE;
		} else {
			return FALSE;
		}

	}

	public function fconnect($data=null) {
		print_r($data);
		if ($data['email'] != "") {
			$query = $this -> db -> get_where('users', array('user_email' => $data['email'], 'user_status' => 1));
			if ($query -> num_rows() == 1) {
				$queryresult = $query -> row();
				$userdata = array('user_email' => $queryresult -> user_email, 'user_id' => $queryresult -> user_id, 'user_logged_in' => TRUE);

				$this -> session -> set_userdata($userdata);
				redirect('product_list');
			} else {
				$this -> db -> insert('users', array('user_email' => $data['email'], 'user_type' => 0, 'user_status' => 1, 'facebook_user' => 1));

				$userdata = array('user_email' => $data['email'], 'user_id' => $this -> db -> insert_id(), 'user_logged_in' => TRUE);
				$this -> session -> set_userdata($userdata);
				redirect('product_list');
			}
		}
	}

}
?>