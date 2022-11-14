//input validation for phone number
//input validation for email
//input validation for name (first, last)
const selectEmployee = function () {
	let templateSource = $('#employeeTemplate').html();
	
	let template = Handlebars.compile(templateSource);
	
	$.ajax({
		type : "GET",
		contentType : "application/json",
		url : "http://cgi.soic.indiana.edu/~jang27/employee_select.php",
		success : function(data, status, xhr) {
			JSON.parse(data).result.forEach(employee => {
				$('#employee-list-container').append(template(employee));
			})
		},
		error : function(request, status, error) {
			console.log(request);
			console.log(status);
			alert("Fail");
		}
	})
};

const setEditButton = function (btn) {
	let id = $(btn).closest('.employee-tr').children('.employee-td-id').html();
	let email = $(btn).closest('.employee-tr').children('.employee-td-email').html();
	let firstName = $(btn).closest('.employee-tr').children('.employee-td-firstName').html();
	let lastName = $(btn).closest('.employee-tr').children('.employee-td-lastName').html();
	let phone = $(btn).closest('.employee-tr').children('.employee-td-phone').html();
	let admin = $(btn).closest('.employee-tr').children('.employee-td-admin').html();
	let active = $(btn).closest('.employee-tr').children('.employee-td-active').html();
		
	window.location.href = "employee_edit.html?id=" + id 
								+"&email=" + email 
								+ "&firstName=" + firstName 
								+ "&lastName=" + lastName 
								+ "&phone=" + phone
								+ "&admin=" + admin 
								+ "&active=" + active;
};

const setDeleteButton = function (btn) {
	let employeeId = $(btn).closest('.employee-tr').children('.employee-td-id').html();
	
	$.ajax({
		type : "GET",
		contentType : "application/json;",
		data: {id: employeeId},
		url : "http://cgi.soic.indiana.edu/~jang27/activity_log_select.php",
		success : function(data, status, xhr) {
			let resultData = JSON.parse(data).result;
			
			if (Array.isArray(resultData) && (resultData.length > 0)) {
				alert("Please delete activity first");
			} else {
				deleteEmployee(employeeId);
			}
		},
		error : function(request, status, error) {
			console.log(request);
			console.log(status);
			alert("Error");
		}
	})
};

const deleteEmployee = function (employeeId) {
	$.ajax({
		type : "POST",
		url : "http://cgi.soic.indiana.edu/~jang27/employee_delete.php",
		data : {id: employeeId},
		success : function(data, status, xhr) {
			console.log(data);
			alert("Success");
			
			window.location.reload();
		},
		error : function(request, status, error) {
			console.log(request);
			console.log(status);
			console.log(error);
			alert("Fail");
		}
	});
}

document.addEventListener("DOMContentLoaded", function() {
	selectEmployee();
});