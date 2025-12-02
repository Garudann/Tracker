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
                        WHEN t.status = 1 THEN 'Backlog' 
                        WHEN t.status = 2 THEN 'Todo' 
                        WHEN t.status = 3 THEN 'In Progress'
                        WHEN t.status = 4 THEN 'In Review'
                        WHEN t.status = 5 THEN 'Approved'
                        WHEN t.status = 6 THEN 'Completed'
                        WHEN t.status = 7 THEN 'Rejected'
                        ELSE '-' 
                    END AS status,
                    e.name AS created_emp, t.created_at, t.created_by,t.assignto,t.status AS status_id
                FROM tasks t
                JOIN employee e ON t.created_by = e.id
                ORDER BY t.created_at DESC";
        return $this->db->query($sql)->result();
    }

    public function get_active_employees() {
        $sql = "SELECT id, name,mobile, username, date(Joined_date) as join_date, profile, is_active FROM employee WHERE is_active = 1";
        return $this->db->query($sql)->result();
    }

    public function insert_task($data) {
        return $this->db->insert('tasks', $data);
    }

    public function get_task_status(){
        $sql = "select name, id from taskstatus where STATUS=1";
        return $this->db->query($sql)->result();
    }

    function get_all_users(){
        $sql = "SELECT id, name, username, is_active, mobile
        FROM employee
        Where is_active=1";
        return $this->db->query($sql)->result();
    }

}