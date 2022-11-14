<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<script type="employee-template" id="employeeTemplate">
<tr>
	<td>{{id}}</th>
	<td>{{email}}</th>
	<td>{{firstName}}</th>
	<td>{{lastName}}</th>
	<td>{{phone}}</th>
	<td>{{admin}}</th>
	<td>{{active}}</th>
</tr>
</script>

<script type="activity-template" id="activitySearchTemplate">
<option value="">{{employeeName}}</option>
</script>
</body>
</html>