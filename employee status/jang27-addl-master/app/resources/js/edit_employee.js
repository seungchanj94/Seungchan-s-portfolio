let employeeId = '';

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

const setEmployeeParameter = function () {
	$('#emailInput').val(getParameter('email'));
	$('#firstNameInput').val(getParameter('firstName'));
	$('#lastNameInput').val(getParameter('lastName'));
	$('#phoneInput').val(getParameter('phone'));
	$('#adminInput').val(getParameter('admin'));
	let activeParam = getParameter('active');
	if(activeParam === 'Y') {
		$('#activeInput').val(true);
	} else {
		$('#activeInput').val(false);
	}
};

const ValidationUtil = function() {};

ValidationUtil.prototype = {
		isValidPhoneNumber(phoneNumber) {
			return (/^8[1-9][0|1|2|3|6|7|8|9]?[0-9]{3,4}[0-9]{3,5}$/).test(phoneNumber);
		},

		isValidEmail(email) {
			return (/^([\w-.]+)@(\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i).test(email);
		},
		
		isValidName(name) {
			return (name != "" && name);
		}
};
// Figure out valid info
// every information should be inserted
const isValidationEmployee = function() {
	let validationUtil = new ValidationUtil();
	
	if(validationUtil.isValidEmail($("#emailInput").val()) === false) {
		return {valid : false, message : "email is invalid"};
	}
	
	if(validationUtil.isValidName($("#firstNameInput").val()) === false) {
		return {valid : false, message : "firstName is invalid"};
	}
	
	if(validationUtil.isValidName($("#lastNameInput").val()) === false) {
		return {valid : false, message : "lastName is invalid"};
	}
	
	if(validationUtil.isValidPhoneNumber($("#phoneInput").val()) === false) {
		return {valid : false, message : "phoneNumber is invalid"};
	}
	
	if(validationUtil.isValidName($("#adminInput").val()) === false) {
		return {valid : false, message : "admin is invalid"};
	}
	
	return {valid : true, message : ""};
};
// submit employee and send the data
const editEmployee = function() {
	let sendData = {
			id: employeeId,
			email: $('#emailInput').val(),
			first_name: $('#firstNameInput').val(),
			last_name: $('#lastNameInput').val(),
			phone: $('#phoneInput').val(),
			admin: $('#adminInput').val(),
			active: $('input:checkbox[id=activeInput]').is(":checked") === true ? 'Y' : 'N'
	}
// this is how connect with database but I will work on it later
	if(employeeId === null || employeeId === '') {
		alert('error');
		return;
	}

	$.ajax({
		type : "POST",
		url : "http://cgi.soic.indiana.edu/~jang27/employee_edit.php", //I would need to work on php here ex) 10.200.300.4/setEmployee.php
		data : sendData,
		success : function(data, status, xhr) {
			alert("Success");
			location.href = "/~jang27/additional_app/entry.html";
		},
		error : function(request, status, error) {
			console.log(request);
			console.log(status);
			alert("Fail");
		}
	})
};

document.addEventListener("DOMContentLoaded", function() {
	employeeId = getParameter('id');
	
	$('#submitButton').click(function () {
		editEmployee();
	});
	
	
	setEmployeeParameter();
});