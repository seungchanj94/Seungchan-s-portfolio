//input validation for phone number
//input validation for email
//input validation for name (first, last)
let glbEmployeeId = "";

const getParameter = function (param) {
            let returnValue;
            let url = location.href;
            let parameters = (url.slice(url.indexOf('?') + 1, url.length)).split('&');
            for (let i = 0; i < parameters.length; i++) {
                let varName = parameters[i].split('=')[0];
                if (varName.toUpperCase() == param.toUpperCase()) {
                    returnValue = parameters[i].split('=')[1];
                    return decodeURIComponent(returnValue);
                }
            }
};
// submit employee and send the data
const submitActivity = function() {
	let sendData = {
			employeeId : glbEmployeeId,
			startDatetime: $('#startDateInput').val(),
			endDatetime: $('#endDateInput').val(),
			note: $('#noteInput').val()
	}
	console.log(sendData);
// this is how connect with database but I will work on it later
	$.ajax({
		type : "POST",
		/*contentType : "application/json;",
		dataType : "json",*/
		url : "http://cgi.soic.indiana.edu/~jang27/activity_insert.php", //I would need to work on php here ex) 10.200.300.4/setEmployee.php
		data : sendData,
		success : function(data, status, xhr) {
			alert("Success");
			location.href = "/~jang27/additional_app/activity_log_info.html";
		},
		error : function(request, status, error) {
			console.log(request);
			console.log(status);
			alert("Fail");
		}
	})
};

//submit button to create the employee
// if not valid, it will give user an error message.
// ex) phone input is invalid.
const setSubmitButton = function() {
	$("#submitButton").click(function() {
		submitActivity();
	})
};

document.addEventListener("DOMContentLoaded", function() {
	setSubmitButton();
	glbEmployeeId = getParameter("emp_id");
	
});