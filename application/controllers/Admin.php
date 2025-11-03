<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('uid')) {
            redirect('login');
        }
    }

    public function dashboard() {
        //echo "<pre>";print_r($this->session->userdata());
        $this->load->view('admin/dashboard');
    }

    public function task_list() {
        if (!$this->session->userdata('uid')) {
            redirect('login');
        }
        $this->load->view('admin/task_list');
    }

    public function get_tasks() {
        if (!$this->session->userdata('uid')) {
            echo json_encode([]);
            return;
        }
        $this->load->model('Admin_Model');
        $tasks = $this->Admin_Model->get_all_tasks();

        echo json_encode($tasks);
    }

    public function Add_task() {
        if (!$this->session->userdata('uid')) {
            redirect('login');
        }
        $this->load->view('admin/add_task');
    }

    public function get_active_employees() {
        if (!$this->session->userdata('uid')) {
            echo json_encode([]);
            return;
        }
        $this->load->model('Admin_Model');
        $employees = $this->Admin_Model->get_active_employees();

        echo json_encode($employees);
    }

    public function save_task() {
        if (!$this->session->userdata('uid')) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            return;
        }
        $this->load->model('Admin_Model');

        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $assignee = $this->input->post('assignee');
        $category = $this->input->post('category');

        $task_data = [
            'title' => $title,
            'description' => $description,
            'status' => 1,
            'created_by' => $this->session->userdata('uid'),
            'created_at' => date('Y-m-d H:i:s'),
            'assignto' => $assignee,
            'category' => $category
        ];

        $insert_id = $this->Admin_Model->insert_task($task_data);

        if ($insert_id) {
            echo json_encode(['status' => 'success', 'message' => 'Task created successfully..']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to create task!']);
        }
    }

    public function get_taskstatus() {
        if (!$this->session->userdata('uid')) {
            echo json_encode([]);
            return;
        }
        $this->load->model('Admin_Model');
        $status = $this->Admin_Model->get_task_status();

        echo json_encode($status);
    }

    function update_task_status() {
        $task_id = $this->input->post('task_id');
        $new_status = $this->input->post('status_id');
        $this->load->model('Admin_Model');
        $update_data = ['status' => $new_status];
        $this->db->where('id', $task_id);
        $updated = $this->db->update('tasks', $update_data);

        if ($updated) {
            echo json_encode(['status' => 'success', 'message' => 'Task status updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update task status.']);
        }
    }

}
