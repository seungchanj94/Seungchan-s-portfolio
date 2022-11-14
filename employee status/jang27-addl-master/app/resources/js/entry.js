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


//get Employee list in index page I meant home page.
const getEmployeeList = function() {
	$.ajax({
		type: "GET",
		url: "",
		dataType: "json",
		success: function(employeeList) {
			let $employeeContainer = $("#employee-list-container");
			
			if(employeeList) {
				let bindTemplate = Handlebars.compile($("#employeeTemplate").html());
				
				employeeList.forEach(function(employee) {
					$employeeContainer.append(bindTemplate(employee));
				}.bind(this))
			}
		}
	});
	
	let $employeeContainer = $("#employee-list-container");
	
	let employeeList = [{id: "test", email: "test", firstName: "test", lastName: "test", phone: "010-000-0000", admin: "test", active: "test"}];
	
	if(employeeList) {
		let bindTemplate = Handlebars.compile($("#employeeTemplate").html());
		
		employeeList.forEach(function(employee) {
			$employeeContainer.append(bindTemplate(employee));
		}.bind(this))
	}
};



document.addEventListener("DOMContentLoaded", function() {
	getEmployeeList();
});