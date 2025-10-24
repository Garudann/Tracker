<head>
    <title>Admin | Task List</title>
</head>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<div class="main-content">
    <h2>Task List</h2>
    <a href="<?= base_url('admin/Add_task'); ?>" class="add-task">+ Add New Task</a>
    <div class="container">
        <table id="taskTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <p id="noTasksMessage" style="text-align:center; color:#ddd; display:none;">No tasks found.</p>
    </div>
</div>
<!-- CSS -->
<style>
body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    background: url(https://i.redd.it/cdb8iertk00f1.png) no-repeat center fixed;
    background-size: cover;
}
.main-content {
    position: relative;
    margin-left: 250px;
    padding-top: 80px;
    padding-left: 20px;
    padding-right: 20px;
    min-height: calc(100vh - 80px);
    color: white;
    font-family: Arial, sans-serif;
}
.container {
    backdrop-filter: blur(3px);
    border-radius: 10px;
    padding: 20px;
    max-width: 90%;
    margin: 0 auto;
}
h2 {
    text-align: left;
    margin-bottom: 20px;
    display: inline-block;
}
.add-task {
    position: absolute;
    top: 100px;
    right: 115px;
    background: transparent;
    color: #fff;
    padding: 8px 12px;
    border-radius: 5px;
    text-decoration: none;
    z-index: 10;
    font-weight: bold;
    border: 2px solid #000000ff;
}
.add-task:hover {
    backdrop-filter: blur(5px);
    color: #00bfff;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
table th, table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #cfc4c4ff;
}
table th { backdrop-filter: blur(5px); color: white; text-align: center; }
table tr:nth-child(even) { background: rgba(255,255,255,0.1); }
.status { font-weight: bold; text-transform: capitalize; }
.status.Pending { color: orange; }
.status.Completed { color: #28a745; }
.actions a {
    text-decoration: none;
    margin-right: 8px;
    color: #00bfff;
}
.actions a:hover { text-decoration: underline; }
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.container { animation: fadeIn 1.2s ease-in-out; }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    var base_url = "<?= base_url(); ?>";
</script>
<script src="<?= base_url('assets/js/general.js'); ?>"></script>