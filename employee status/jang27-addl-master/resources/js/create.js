//input validation for phone number
//input validation for email
//input validation for name (first, last)
const ValidationUtil = function() {};

ValidationUtil.prototype = {
		isValidPhoneNumber(phoneNumber) {
			return (/^0[1-7][0|1|2|3|6|7|8|9]?[-][0-9]{3,4}[-][0-9]{3,5}$/).test(phoneNumber);
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
const submitEmployee = function() {
	let sendData = {
			email: $('#emailInput').val(),
			firstName: $('#firstNameInput').val(),
			lastName: $('#lastNameInput').val(),
			phone: $('#phoneInput').val(),
			admin: $('#adminInput').val(),
			active: $('input:checkbox[id=activeInput]').is(":checked") === true ? 'Y' : 'N'
	}
// this is how connect with database but I will work on it later
	/*$.ajax({
		type : "POST",
		contentType : "application/json;",
		dataType : "json",
		url : "employee_form.php", //I would need to work on php here ex) 10.200.300.4/setEmployee.php
		data : sendData,
		success : function(data, status, xhr) {
			alert("Success");
			location.href = "/management/entry";
		},
		error : function(request, status, error) {
			alert("Fail");
		}
	})*/
};

//submit button to create the employee
// if not valid, it will give user an error message.
// ex) phone input is invalid.
const setSubmitButton = function() {
	$("#submitButton").click(function() {
		let isValid = isValidationEmployee();
		if(isValid.valid) {
			submitEmployee();
		} else {
			alert(isValid.message);
		}
	})
};

document.addEventListener("DOMContentLoaded", function() {
	setSubmitButton();
});