<?php
class Admin_model extends CI_Model {

    public function check_login($username, $password) {
        $query = $this->db->query(
            "SELECT * FROM employee WHERE username = ? AND password = ? LIMIT 1", 
            array($username, $password)
        );

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_all_tasks() {
        return $this->db->get('tasks')->result();
    }

    public function get_active_employees() {
        $sql = "SELECT id, name FROM employee WHERE is_active = 1";
        return $this->db->query($sql)->result();
    }

}