<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* File Name : category_model.php
 * Author:Karthick Kumar
 * Description: Category Management
 * Created Date:30-05-2015
 * Modified Date:31-05-2015
 */
class Category_Model extends CI_Model {

    public function getCategoryList() {
        $query = $this -> db -> get('category');
        $results = $query -> result();
        return $results;
    }

    public function getCategory() {
        $query = $this -> db -> get_where('category', array('category_id' => $this -> input -> post('category_id')));
        if ($query -> num_rows() == 1) {
            $results = $query -> row();
            return $results;

        } else {
            return 0;
        }
    }

    public function saveCategory() {
        $categoryname = $this -> input -> post('category_name');
        if ($this -> db -> insert('category', array('category_name' => $categoryname))) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    public function updateCategory() {
        $categoryname = $this -> input -> post('category_name');
        $categoryid = $this -> input -> post('category_id');
        $data = array('category_name' => $categoryname);

        $this -> db -> where('category_id', $categoryid);
        // $this -> db -> update('category', $data);
        if ($this -> db -> update('category', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    public function deleteCategory() {
        $categoryid = $this -> input -> post('category_id');
        if ($this -> db -> delete('category', array('category_id' => $categoryid))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
?>