<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Add New Task</title>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background: url(https://i.redd.it/cdb8iertk00f1.png) no-repeat center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .main-content {
            position: relative;
            margin-left: 250px;
            padding-top: 80px;
            padding-left: 20px;
            padding-right: 20px;
            min-height: calc(100vh - 80px);
            color: white;
        }

        .container {
            backdrop-filter: blur(3px);
            border-radius: 10px;
            padding: 30px;
            max-width: 6000px;
            margin: 0 auto;
            background: 'transparent';
            animation: fadeIn 1.2s ease-in-out;
        }

        h2 {
            text-align: left;
            margin-bottom: 30px;
            color: white;
            font-size: 28px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        ::placeholder {
            color: #ccc;
        }
        .create_task-table td {
            padding: 10px;
        }
        .create-task-table label {
            color: white !important;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php $this->load->view('includes/header'); ?>
    <?php $this->load->view('includes/sidebar'); ?>
    <div class="main-content">
        <h2>Add New Task</h2>
        <div class="container"> 
            <form action="<?= base_url('admin/save_task'); ?>" method="POST" id="taskForm">
                <table style="width:100%; gap:15px;" class="create-task-table">
                    <tr>
                        <td><label for="title">Title *</label></td>
                        <td><input type="text" id="title" name="title" required placeholder="Enter task title" style="width:100%; padding:8px; border-radius:5px; border:none;"/></td>
                    </tr>
                    <tr>
                        <td><label for="description">Description *</label></td>
                        <td><textarea id="description" name="description" required placeholder="Enter task description" style="width:100%; padding:8px; border-radius:5px; border:none;"></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="due_date">Due Date *</label></td>
                        <td><input type="date" id="due_date" name="due_date" required style="width:100%; padding:8px; border-radius:5px; border:none;"/></td>
                    </tr>
                    <tr>
                        <td><label for="status">Status *</label></td>
                        <td>
                            <select id="status" name="status" required style="width:100%; padding:8px; border-radius:5px; border:none;">
                                <option value="0">Backlogs</option>
                                <option value="1">To Do</option>
                                <option value="2">In Progress</option>
                                <option value="3">In Review</option>
                                <option value="4">Approved</option>
                                <option value="5">Rejected</option>
                                <option value="6">Completed</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="assignee">Assign To *</label></td>
                        <td>
                            <select id="employee_select" name="assignee" required style="width:100%; padding:8px; border-radius:5px; border:none;">
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="btn-group">
                    <button type="submit" class="btn btn-submit">Create Task</button>
                    <a href="<?= base_url('admin/task_list'); ?>" class="btn btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
<script>
var base_url = "<?= base_url(); ?>";
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/general.js'); ?>"></script>