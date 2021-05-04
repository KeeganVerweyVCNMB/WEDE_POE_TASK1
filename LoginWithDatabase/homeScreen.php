<html>
	<head>
	<title>HOME PAGE</title>
	<link href = "loginStyle.css" rel = "stylesheet" type = "text/css" />
	</head>
	<body class = "background">
	<form action = "homeScreen.php" method = "post">
	<div style = "font-size: 30px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-style: oblique;"><u>WELCOME TO OUR TEAM ENTRIES!</u></div>
	
		<table>
			<tr>
				<td>
					<div>Enter the amount of entered teams:</div>
				</td>
				<td>
					<div>
						<input name = "txtRows" type = "number"/>
					</div> 
				</td>
		
		</table>
		<input type = "submit" name = "btnCreate" 
			value = "SUBMIT TEAM AMOUNT" style = "width: 170px; height: 30px; margin-bottom: 20px;" >

			<input type = "submit" name = "btnLogOut" 
			value = "LOG OUT" style = "width: 130px; height: 30px; margin-bottom: 20px; margin-left: 1010px;" >

<?php 
		session_start();

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$rows = 0;
		}

			if (isset($_POST['btnLogOut']))
			{
				header("Location: LoginApp.php?");
			}

			if (isset($_POST['btnCreate']))
			{
				$_SESSION["rows"] = $_POST['txtRows'];
				
				print "</br>";
				print "</br>";
					
				print "<table border = 1>";
					for ($y = 1; $y <= $_SESSION["rows"]; $y++)
					{
						print "<tr>";
							print "<td>";
							print "TEAM $y: </div>";
							print "</td>";
							print "<td>";
							print '<input name="teams[]" type = "text"/>';
							print "</td>";
						print "</tr>";
					}
				print "</table>";
				print '<input type = "submit" name = "btnSubmit" 
			 			value = "  SUBMIT" style = "margin-top:20px; width: 100px;
						 height: 30px;" >';
			}
			if (isset($_POST['btnSubmit']))
			{
				$x = 1;
				print "<table border = 1";
				foreach($_POST['teams'] as $key => $value)
				{
					print "<tr>";
						print "<td>";
					  		echo "TEAM $x: ";
				  		print "</td>";
				  		print "<td>";
				  			echo $value."<br>";
				  		print "</td>";
			  		print "</tr>";
				  $x += 1;
				}
				print "</table>";
			}
?>
    </form>
  </body>
</html>

<html>
	<head>
		<style>
			#toggleElement {
			width: 100%;
			padding: 50px 0;
			text-align: center;
			background-color: lightblue;
			margin-top: 20px;
			}

			#showDiv_image {
			width: 500px;
			height: 350px;
			}  

			#home_button {
			width: 160px;
   			height: 40px;
			margin-top: 20px;
			background-color: lightgray;
			}
		</style>
</head>
<body>

<button id="home_button" onclick="myFunction()">TOGGLE YOUR DIV</button>

<div id="toggleElement">
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFtjfwODgx8z6pIR92fR6DhNe19lSPDYrqnA&usqp=CAU" alt="Show Image Div" id = "showDiv_image">
</div>

	<script>
		function myFunction() {
			var x = document.getElementById("toggleElement");
			if (x.style.display === "none") {
				x.style.display = "block";
			} else {
			x.style.display = "none";
			}
		}
	</script>

</body>
</html>



