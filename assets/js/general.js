var taskTable;
var ctrl_page = window.location.pathname.split('/');
let taskStatuses = [];
function get_activeTaskStatus(selectIds = ['#status', '#markas'], callback = null) {
    $.ajax({
        url: base_url + "admin/get_taskstatus",
        method: "GET",
        dataType: "json",
        success: function (data) {
            // console.log("Active task statuses:", data);
            taskStatuses = data || [];
            selectIds.forEach(function (id) {
                var select = $(id);
                if (select.length === 0) return;
                select.empty();

                if (taskStatuses.length > 0) {
                    select.append('<option value="">Select Status</option>');
                    $.each(taskStatuses, function (index, status) {
                        select.append($('<option></option>').val(status.id).text(status.name));
                    });
                } else {
                    select.append('<option value="">No active task statuses found</option>');
                }
            });
            if (typeof callback === "function") callback();
        },
        error: function (xhr, status, error) {
            console.error('Error loading active task statuses:', error);
            alert('Failed to load active task statuses');
        }
    });
}
function get_active_employees() {
    $.ajax({
        url: base_url + "admin/get_active_employees",
        method: "GET",
        dataType: "json",
        success: function (data) {
            var select = $('#employee_select');
            console.log("Active employees:", data);
            select.empty();
            if (data && data.length > 0) {
                $.each(data, function (index, employee) {
                    select.append($('<option></option>').val(employee.id).text(employee.name));
                });
            } else {
                select.append($('<option></option>').val('').text('No active employees found'));
            }
        },
        error: function (xhr, status, error) {
            console.error('Error loading active employees:', error);
            alert('Failed to load active employees');
        }
    });
}

function loadTasks() {
    $.ajax({
        url: base_url + "admin/get_tasks",
        method: "GET",
        dataType: "json",
        success: function (tasks) {
            console.log("Tasks list", tasks);
            if (!taskTable) {
                taskTable = $('#taskTable').DataTable({
                    "columnDefs": [
                        { targets: [1, 2, 3, 4, 5], className: 'dt-body-left' },
                        { targets: [0], className: 'dt-body-center' },
                        { targets: [6], className: 'actions' }
                    ],
                    "ordering": true,
                    "paging": true,
                    "searching": true,
                    "autoWidth": false,
                    "createdRow": function (row, data, dataIndex) {
                        var status = $(row).find("select.markas option:selected").text() || data[3];
                        $(row).css('color', 'white');
                    },
                    "initComplete": function () {
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
            $('#taskTable').on('draw.dt', function () {
                $('.markas').css({
                    'background-color': '#222',
                    'color': '#fff',
                    'border': '1px solid #555',
                    'border-radius': '6px',
                    'padding': '4px 8px',
                    'font-size': '14px',
                    'cursor': 'pointer',
                    'width': '100%',
                    'outline': 'none'
                });

                $('.markas option').css({
                    'background-color': '#333',
                    'color': '#fff'
                });
            });

            taskTable.clear();
            if (!tasks || tasks.length === 0) {
                taskTable.row.add([
                    'No data', 'No data', 'No tasks found', 'No data', 'No data', 'No data', 'No data'
                ]).draw(false);
            } else {
                tasks.forEach(function (task) {
                    var statusOptions = '<select class="markas" data-task-id="' + task.id + '">';
                    statusOptions += '<option value="">Select Status</option>';
                    taskStatuses.forEach(function (status) {
                        var selected = (status.id == task.status_id) ? 'selected' : '';
                        statusOptions += `<option value="${status.id}" ${selected}>${status.name}</option>`;
                    });
                    statusOptions += '</select>';
                    var statusCell = (task.created_by == currentUserId || task.assignto == currentUserId)
                        ? statusOptions
                        : task.status || '';
                    var actions = (task.created_by == currentUserId || task.assignto == currentUserId)
                        ? `<a href="#" class="edit-link">Edit</a> | <a href="#" class="delete-link">Delete</a>`
                        : `<span style="color:#aaa;">No actions</span>`;
                    if (task.status_id == 6) {
                        $('.markas').prop('disabled', true);
                    } else {
                        $('.markas').prop('disabled', false);
                    }
                    taskTable.row.add([
                        task.id || '',
                        task.title || '',
                        task.description || '',
                        statusCell,
                        task.created_emp || '',
                        task.created_at || '',
                        actions
                    ]).draw(false);
                });
            }
        },
        error: function (xhr, status, error) {
            console.error('Error loading tasks:', error);
            alert('Failed to load tasks');
        }
    });
}

$(document).on('change', '.markas', function () {
    var taskId = $(this).data('task-id');
    var selectedStatus = $(this).val();
    var selectedText = $(this).find('option:selected').text();

    if (!selectedStatus) return;

    $.ajax({
        url: base_url + "admin/update_task_status",
        method: "POST",
        data: {
            task_id: taskId,
            status_id: selectedStatus
        },
        dataType: "json",
        error: function (xhr, status, error) {
            console.error("Error updating task status:", error);
        }
    });
});
$('#createTaskBtn').on('click', function (e) {
    e.preventDefault();
    var title = $('#title').val().trim();
    var description = $('#description').val().trim();
    var employee_id = $('#employee_select').val();
    var assignee = $('#employee_select option:selected').text();
    var category = $('#category option:selected').val();
    if (!title || !description || !employee_id || !category) {
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
            assignee_name: assignee,
            category: category
        },
        success: function (response) {
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
        error: function (xhr, status, error) {
            console.error('Error creating task:', error);
            alert('Failed to create task');
        }
    });
});
$('#cancelTaskBtn').on('click', function (e) {
    e.preventDefault();
    window.location.href = base_url + "admin/task_list";
});
$(document).ready(function () {
    if (ctrl_page.length > 3 && ctrl_page[3] === 'task_list') {
        get_activeTaskStatus([], loadTasks);
    }
    if (ctrl_page.length > 3 && ctrl_page[3] === 'Add_task') {
        get_active_employees();
        get_activeTaskStatus();
    }
});
