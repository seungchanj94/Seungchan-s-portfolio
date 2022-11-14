//input validation for phone number
//input validation for email
//input validation for name (first, last)
let searchParam = {
	id: '',
	email: '',
	startDatetime: '',
	endDatetime: ''
};

const selectActivity = function () {
	let templateSource = $('#activityTemplate').html();
	
	let template = Handlebars.compile(templateSource);
	
	$.ajax({
		type : "GET",
		contentType : "application/json;",
		data: searchParam,
		url : "http://cgi.soic.indiana.edu/~jang27/activity_log_search.php",
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
};



const selectEmployee = function () {
	let templateSource = $('#employeeSelectTemplate').html();
	
	let template = Handlebars.compile(templateSource);
	
	$.ajax({
		type : "GET",
		contentType : "application/json;",
		url : "http://cgi.soic.indiana.edu/~jang27/employee_select.php",
		success : function(data, status, xhr) {
			JSON.parse(data).result.forEach(employee => {
				$('#select-employee-name').append(template(employee));
			})
		},
		error : function(request, status, error) {
			console.log(request);
			console.log(status);
			alert("Fail");
		}
	})
};

const setOnChangeSelectBox = function () {
	$('#select-employee-name').change(function () {
		searchParam.id = this.value;
	});
};

const setSearchButton = function () {
	if ($('#startDateSearchInput').val() == '') {
		if($('#endDateSearchInput').val() !== '') {
			alert('plz set endDate');
		}
	}
	
	if ($('#endDateSearchInput').val() == '') {
		if($('#startDateSearchInput').val() !== '') {
			alert('plz set startDate');
		}
	}
	
	$('#searchButton').click(function () {
		searchParam.email = $('#emailSearchInput').val();
		searchParam.startDatetime = $('#startDateSearchInput').val();
		searchParam.endDatetime = $('#endDateSearchInput').val();
		
		selectActivity();
	});
};

const setEditButton = function (btn) {
	let activityId = $(btn).closest('.activity-tr').children('.activity-id').html();
	let email = $(btn).closest('.activity-tr').children('.activity-employee-email').html();
	let firstName = $(btn).closest('.activity-tr').children('.activity-employee-first-name').html();
	let lastName = $(btn).closest('.activity-tr').children('.activity-employee-last-name').html();
	let phone = $(btn).closest('.activity-tr').children('.activity-employee-phone').html();
	let admin = $(btn).closest('.activity-tr').children('.employee-td-admin').html();
	let active = $(btn).closest('.activity-tr').children('.activity-employee-active').html();
	let startDatetime = $(btn).closest('.activity-tr').children('.activity-start-datetime').html();
	let endDatetime = $(btn).closest('.activity-tr').children('.activity-end-datetime').html();	
	
	window.location.href = "activity_edit.html?activityId=" + activityId 
								+ "&email=" + email 
								+ "&firstName=" + firstName 
								+ "&lastName=" + lastName 
								+ "&phone=" + phone
								+ "&admin=" + admin 
								+ "&active=" + active
								+ "&startDatetime=" + startDatetime
								+ "&endDatetime=" + endDatetime;
};

const setDeleteButton = function (btn) {
	let activityId = $(btn).closest('.activity-tr').children('.activity-id').html();
	
	deleteActivity(activityId);
};

const deleteActivity = function (activityId) {
	$.ajax({
		type : "POST",
		url : "http://cgi.soic.indiana.edu/~jang27/activity_delete.php",
		data : {id: activityId},
		success : function(data, status, xhr) {
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
	setOnChangeSelectBox();
	setSearchButton();
});