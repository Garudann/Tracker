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
        $sql = "SELECT t.id, t.title, t.description, CASE 
                        WHEN t.status = 0 THEN 'Backlog' 
                        WHEN t.status = 1 THEN 'Todo' 
                        WHEN t.status = 2 THEN 'In Progress'
                        WHEN t.status = 3 THEN 'In Review'
                        WHEN t.status = 4 THEN 'Approved'
                        WHEN t.status = 5 THEN 'Rejected'
                        WHEN t.status = 6 THEN 'Completed'
                        ELSE '-' 
                    END AS status,
                    e.name AS created_emp, t.created_at
                FROM tasks t
                JOIN employee e ON t.created_by = e.id
                ORDER BY t.created_at DESC";
        return $this->db->query($sql)->result();
    }

    public function get_active_employees() {
        $sql = "SELECT id, name FROM employee WHERE is_active = 1";
        return $this->db->query($sql)->result();
    }

    public function insert_task($data) {
        return $this->db->insert('tasks', $data);
    }

}