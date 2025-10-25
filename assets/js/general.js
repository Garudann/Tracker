var taskTable;
var ctrl_page = window.location.pathname.split('/');

function loadTasks() {
    $.ajax({
        url: base_url + "admin/get_tasks",
        method: "GET",
        dataType: "json",
        success: function(tasks) {
            console.log("Tasks list", tasks);
            if (!taskTable) {
                taskTable = $('#taskTable').DataTable({
                    "columnDefs": [
                        {
                            targets: [1, 2, 3, 4, 5],
                            className: 'dt-body-left'
                        },
                        {
                            targets: [0],
                            className: 'dt-body-center'
                        },
                        {
                            targets: [6],
                            className: 'actions'
                        }
                    ],
                    "ordering": true,
                    "paging": true,
                    "searching": true,
                    "autoWidth": false,
                    "createdRow": function(row, data, dataIndex) {
                        var status = data[4];
                        var color = 'white';
                        if (status === 'Completed') color = 'green';
                        else if (status === 'Pending') color = 'orange';
                        else if (status === 'In Progress') color = 'yellow';
                        $(row).css('color', color);
                    },
                    "initComplete": function() {
                        $('.dataTables_paginate .paginate_button a').css('color', 'white');
                    }
                });
                
                $('#taskTable_length').css({
                    'display': 'flex',
                    'justify-content': 'end',
                    'align-items': 'center',
                    'margin-bottom': '10px',
                    'gap': '8px'
                });
                $('#taskTable_length label').css({
                    'font-weight': 'bold',
                    'color': '#ffffffff'
                });
                $('#taskTable_length select').css({
                    'border': '1px solid #666',
                    'border-radius': '6px',
                    'padding': '4px 8px',
                    'background': 'transparent',
                    'color': '#ffffff',
                    'cursor': 'pointer'
                });
                $('#taskTable_length select option').css({
                    'background-color': '#333',
                    'color': '#fff',
                    'font-size': '14px',
                    'padding': '5px'
                });
            }
            
            taskTable.clear();
            if (!tasks || tasks.length === 0) {
                taskTable.row.add([
                    'No data', 'No data', 'No tasks found', 'No data', 'No data', 'No data', 'No data', 'No data'
                ]).draw(false);
            } else {
                tasks.forEach(function(task){
                    // var statusClass = task.status ? task.status.replace(/\s+/g, '-') : '';
                    taskTable.row.add([
                        task.id || '',
                        task.title || '',
                        task.description || '',
                        // task.due_date || '',
                        task.status || '',
                        task.created_emp || '',
                        task.created_at || '',
                        `<a href="#" class="edit-link">Edit</a> | <a href="#" class="delete-link">Delete</a>`
                    ]).draw(false);
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading tasks:', error);
            alert('Failed to load tasks');
        }
    });
}
function get_active_employees() {
    $.ajax({
        url: base_url + "admin/get_active_employees",
        method: "GET",
        dataType: "json",
        success: function(data) {
            var select = $('#employee_select');
            console.log("Active employees:", data);
            select.empty();
            if (data && data.length > 0) {
                $.each(data, function(index, employee) {
                    select.append($('<option></option>').val(employee.id).text(employee.name));
                });
            } else {
                select.append($('<option></option>').val('').text('No active employees found'));
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading active employees:', error);
            alert('Failed to load active employees');
        }
    });
}

$(document).ready(function(){
    if (ctrl_page.length > 3 && ctrl_page[3] === 'task_list') {
        loadTasks();
    }
    if (ctrl_page.length > 3 && ctrl_page[3] === 'Add_task') {
        get_active_employees();
    }
});
$('#createTaskBtn').on('click', function(e) {
    e.preventDefault();
    var title = $('#title').val().trim();
    var description = $('#description').val().trim();
    // var due_date = $('#due_date').val().trim();
    var employee_id = $('#employee_select').val();
    var assignee = $('#employee_select option:selected').text();
    if (!title || !description || !employee_id) {
        alert('Please fill in all required fields.');
        return;
    }
    $.ajax({
        url: base_url + "admin/save_task",
        method: "POST",
        data: {
            title: title,
            description: description,
            assignee: employee_id,
            assignee_name: assignee
        },
        success: function(response) {
            try {
            var res = JSON.parse(response);
            if (res.status === 'success') {
                alert(res.message);
                window.location.href = base_url + "admin/task_list";
            } else {
                alert(res.message);
            }
        } catch (e) {
            console.error("Invalid JSON response", e);
            alert("Something went wrong.");
        }
        },
        error: function(xhr, status, error) {
            console.error('Error creating task:', error);
            alert('Failed to create task');
        }
    });
});
$('#cancelTaskBtn').on('click', function(e) {
    e.preventDefault();
    window.location.href = base_url + "admin/task_list";
});