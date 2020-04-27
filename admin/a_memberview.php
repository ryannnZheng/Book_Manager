<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>View All Members</title>
		<link rel="stylesheet" href="../css/style.css" />	
	</head>
	<body>
		<div>
			<ul>
				<li><a href="logout.php">Logout</a></li>
				<li><a href="admindashboard.html">Dashboard</a></li>
				<li><b class="active">Library Manage System</>
			</ul>
		</div>
		
		<div class = "container">
			<img src="../css/2.jpg" style="width:100%;">
			<div class = "centered">
	<?php 
			session_start();
			error_reporting(0);
			$conn = new mysqli("localhost","root","","library");

			$sql="SELECT * FROM member ORDER BY name;";
			$result=$conn->query($sql);

			if ($result) 
			{
    			if ($result->num_rows>0) 
				{
					echo "<h2>All Members</h2>";
    				echo "<div><table border=1 ><tr><th>MID</th><th>Name</th><th>DOB</th><th>Address</th><th>Passkey</th></tr>";

	    			while($row = $result->fetch_assoc()) 
	    			{
	    				echo "<tr><td>".$row['MID']."</td><td>".$row['name']."</td><td>".$row['dob']."</td><td>".$row['address']."</td><td>".$row['passkey']."</td><tr>";
	    			}	
	    		
	    			echo "</table></div>";
					echo "<a href=\"admindashboard.html\" class=\"button\">Back</a>";
				} 
				else 
				{
	    			echo "<h2>No Members</h2>";
					echo "<a href=\"admindashboard.html\" class=\"button\">Back</a>";
	    		}
			} 
			else 
			{
    			echo "<h2>Error</h2><p>".$conn->error."</p>";
				echo "<a href=\"admindashboard.html\" class=\"button\">Back</a>";
			}

    		$conn->close();
?>

		</div>
	</div>
</body>
</html>
