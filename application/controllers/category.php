<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        if (!$this -> session -> userdata('admin_logged_in')) {
            redirect('admin');
        }
        $this -> load -> model('category_model');
    }

    public function index() {

        $data['title'] = "Category Managment";
        $data['categories'] = $this -> category_model -> getCategoryList();
        $this -> load -> view('common_files/header', $data);
        $this -> load -> view('common_files/admin_navbar');
        $this -> load -> view('category_view', $data);
        $this -> load -> view('common_files/footer');
    }

    public function get() {
        echo json_encode($this -> category_model -> getCategory());
    }

    public function add() {
        $this -> form_validation -> set_rules('category_name', 'Category Name', 'trim|required|xss_clean|is_unique[category.category_name]');
        if ($this -> form_validation -> run() == FALSE) {
            $errors = validation_errors();
            print_r(json_encode($errors));
        } else {
            if ($this -> category_model -> saveCategory()) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function edit() {
        $this -> form_validation -> set_rules('category_name', 'Category Name', 'trim|required|xss_clean|is_unique[category.category_name]');
        if ($this -> form_validation -> run() == FALSE) {
            $errors = validation_errors();
            print_r(json_encode($errors));
        } else {
            if ($this -> category_model -> updateCategory()) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function delete() {
        if ($this -> category_model -> deleteCategory()) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
