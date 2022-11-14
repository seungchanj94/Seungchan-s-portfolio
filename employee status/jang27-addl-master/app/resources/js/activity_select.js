//input validation for phone number
//input validation for email
//input validation for name (first, last)
let glbEmployeeId = null;

const selectActivity = function (employeeId) {
	let templateSource = $('#activityTemplate').html();
	
	let template = Handlebars.compile(templateSource);
	
	$.ajax({
		type : "GET",
		contentType : "application/json;",
		data: {id: employeeId},
		url : "http://cgi.soic.indiana.edu/~jang27/activity_log_select.php",
		success : function(data, status, xhr) {
			$('#activity-list-container').empty();
			
			JSON.parse(data).result.forEach(activity => {
				$('#activity-list-container').append(template(activity));
			})
		},
		error : function(request, status, error) {
			console.log(request);
			console.log(status);
			alert("Fail");
		}
	})
}



const selectEmployee = function () {
	let templateSource = $('#employeeSelectTemplate').html();
	
	let template = Handlebars.compile(templateSource);
	
	$.ajax({
		type : "GET",
		contentType : "application/json;",
		url : "http://cgi.soic.indiana.edu/~jang27/employee_select.php",
		success : function(data, status, xhr) {
			JSON.parse(data).result.forEach(employee => {
				if(employee.active === 'Y') {
					$('#employee-select').append(template(employee));
				}
			})
		},
		error : function(request, status, error) {
			console.log(request);
			console.log(status);
			alert("Fail");
		}
	})
}

const setOnChangeSelectBox = function () {
	$('#employee-select').change(function () {
		glbEmployeeId = this.value;
		selectActivity(this.value);
	});
}

document.addEventListener("DOMContentLoaded", function() {
	selectEmployee();
	setOnChangeSelectBox();
	
	$('#create-employee').click(function () {
		if (glbEmployeeId === null) {
			alert('Please select employee');
			return false;
		}
		
		window.location.href = "create_activity.html?emp_id=" + glbEmployeeId;
	});
});