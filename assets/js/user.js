var ctrl_page = window.location.pathname.split('/');
$(document).ready(function() {
    if (ctrl_page[3] === 'user') {
        get_active_employees();
    }
});
function get_active_employees() {
    $("#employee_list").html('<tr><td colspan="5">Loading...</td></tr>');
    $.ajax({
        url: base_url + "admin/get_active_employees",
        method: "GET",
        dataType: "json",
        success: function (data) {
            let html = "";
            if (data.length > 0) {
                data.forEach(function (emp, index) {
                    html += `
                        <tr>
                            <td>${emp.id}</td>
                            <td>${emp.name}</td>
                            <td>${emp.mobile}</td>
                            <td>${emp.username}</td>
                            <td>${emp.join_date}</td>
                            <td>${emp.profile}</td>
                            <td>${emp.is_active}</td>
                        </tr>
                    `;
                });
            } else {
                html = `
                    <tr>
                        <td colspan="5">No active employees found</td>
                    </tr>
                `;
            }
            $("#employee_list").html(html);
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
            $("#employee_list").html(`
                <tr>
                    <td colspan="5" style="color:red;">Failed to load employees</td>
                </tr>
            `);
        }
    });
}