<div class="sidebar">
    <h2>.</h2>
    <ul>
        <li onclick="window.location.href='<?= base_url('admin/dashboard'); ?>'">Home</li>
        <li onclick="window.location.href='<?= base_url('admin/task_list'); ?>'">Tasks</li>
        <li onclick="window.location.href='<?= base_url('admin/analytics'); ?>'">Analytics</li>
        <li onclick="window.location.href='<?= base_url('admin/user'); ?>'">User</li>
        <li onclick="window.location.href='<?= base_url('admin/settings'); ?>'">Settings</li>
        <li onclick="window.location.href='<?= base_url('login/logout'); ?>'">Logout</li>
    </ul>
</div>

<style>
html, body { height: 100%; margin: 0; padding: 0; }
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100%;
    color: white;
    overflow-y: auto;
    transition: all 0.3s ease;
}
.sidebar:hover { 
    width: 270px;
    backdrop-filter: blur(5px);
 }
.sidebar h2 { text-align: center; margin: 20px 0; }
.sidebar ul { list-style: none; padding: 0; margin: 0; }
.sidebar ul li { padding: 20px; cursor: pointer; border-left: 5px solid transparent; transition: all 0.3s ease; font-size: 20px; }
.sidebar ul li:hover { border-left: 8px solid #02416b; font-size: 28px; backdrop-filter: blur(50px); }
.dropdown-menu { display: none; list-style: none; padding: 0; margin: 5px 0 0 20px; }
.dropdown-menu li { padding: 10px; cursor: pointer; }
.dropdown-menu li:hover { background-color: #2d476c; }
</style>
