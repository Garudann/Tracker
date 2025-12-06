var userTable;
$(document).ready(function () {
    loadEmployees();
});
function loadEmployees() {
    $.ajax({
        url: base_url + "Admin/get_active_employees",
        method: "GET",
        dataType: "json",
        success: function (employees) {
            if (!Array.isArray(employees)) {
                console.error("Invalid data format");
                return;
            }
            if (!userTable) {
                userTable = $('#userTable').DataTable({
                    paging: true,
                    searching: true,
                    info: true,
                    autoWidth: false,
                    columnDefs: [
                        {
                            targets: [0],
                            className: 'dt-body-center'
                        }
                    ]
                });
            }
            userTable.clear();
            if (employees.length > 0) {
                employees.forEach(emp => {
                    userTable.row.add([
                        emp.id || '',
                        emp.name || '',
                        emp.mobile || '',
                        emp.username || '',
                        emp.join_date || '',
                        emp.profile || '',
                        emp.is_active || ''
                    ]);
                });
            } else {
                userTable.row.add([
                    'No data','No data','No data',
                    'No data','No data','No data','No data'
                ]);
            }
            userTable.draw(false);
        },
        error: function (xhr, status, error) {
            console.error("AJAX error:", error);
            alert("Failed to load employees.");
        }
    });
}