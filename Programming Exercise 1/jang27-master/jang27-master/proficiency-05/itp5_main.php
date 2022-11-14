<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>ITP 5 Main</title>
<meta charset="utf-8">

<!--- This is CSS in HTML to support the calculator design--->
	<style>
		* {
			margin: 0px;
			padding: 0px;
		}
		.button {
			width: 75px;
			height: 50px;
			font-size: 15;
			margin: 2px;
			cursor: pointer;
			border: none;
		}
		
		<!-- in order to show the result more clearly, I used this display class. -->
		#display {
			width: 305px;
			margin: 5px;
			font-size: 25px;
			padding: 5px;
			border: none;
			background-color: transparent;
			position: center;
		}
		.main {
			width: 245px;
			height: 350px;
			background-color: #efecec;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translateX(-50%)translateY(-50%);
			border: 1px;
		}

	</style>
</head>
<body>
<h1> Seungchan Jang / jang27 </h1>

<!-- This is main body for making calculator-->
	<div class="main">
		<!-- This form can show the result of the calculator-->
		<form name="calculator">
			<input id ="display" type = "text" name = "display" readonly>
			<!-- All buttons have certain value and have functions for calculating the input numbers. -->
			<table>	
				<tr>
					<td><input type = "button" class = "button" value = "2" onclick = "calculator.display.value += '2'"></td>
					<td><input type = "button" class = "button" value = "4" onclick = "calculator.display.value += '4'"></td>
					<td><input type = "button" class = "button" value = "clr" onclick = "calculator.display.value = ''"></td>
				</tr>
				
				<tr>
					<td><input type = "button" class = "button" value = "6" onclick = "calculator.display.value += '6'"></td>
					<td><input type = "button" class = "button" value = "8" onclick = "calculator.display.value += '8'"></td>
					<td><input type = "button" class = "button" value = "+" onclick = "calculator.display.value += '+'"></td>
				</tr>
				<!-- "Equal to" button is special for making result. Therefore, I used this coding. -->
				<tr>
					<td><input type = "button" class = "button" value = "0" onclick = "calculator.display.value += '0'"></td>
					<td><input type = "button" class = "button" value = "=" onclick = "calculator.display.value = eval(calculator.display.value)"></td>
					<td><input type = "button" class = "button" value = "รท" onclick = "calculator.display.value += '/'"></td>
				</tr>
			</table>
			<button type="button" class = "translate">Translate</button>
			<p id = "response"></p>
		</form>

	</div>
	<!-- This is the ajax to track all data and report http for the data-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
		<!-- With this script pull the data from the website and get the magic number from the url and allow to post the team number and magic number into the screen-->
		<script>
		$(document).ready(function() {
		$(".translate").click(function(){
		var data = {"team":19, "number":calculator.display.value};
		var clean=JSON.stringify(data);
		console.log(data);
		$.post("http://cgi.sice.indiana.edu/~examples/info-i494/api/index.php/magic-number",data, function(response){
		document.getElementById('response').innerHTML=response.status + ", " + response.message;
		});
		});
		})
		
		</script>

</body>
</html>