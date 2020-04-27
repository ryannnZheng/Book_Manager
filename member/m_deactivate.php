<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Deactivate Your Account</title>
		<link rel="stylesheet" href="../css/style.css" />
	</head>
	<body>
		<div>
			<ul>
				<li><a href="logout.php">Logout</a></li>
				<li><a href="memberdashboard.html">Dashboard</a></li>
				<li><b class="active">Library Manage System</>
			</ul>
		</div>

		<div class = "container">
			<img src="../css/2.jpg" style="width:100%;">
			<div class = "centered">
<?php 
	session_start();
	$conn=new mysqli("localhost","root","","library");
	error_reporting(0);

	$mid=$_SESSION['mid'];
	$pwd=$_POST['passkey'];

	$sql="SELECT * FROM MEMBER WHERE MID = '$mid' AND passkey='$pwd';";
	$result = mysqli_query($conn,$sql);
	

	if($result->num_rows>0)
	{
			$nb = 5;
			$sql2="SELECT * FROM MEMBER WHERE MID='$mid' AND num_borrowed=$nb;";
			$result=$conn->query($sql2);

			if($result->num_rows>0)
			{
				$sql3="DELETE FROM MEMBER WHERE MID='$mid';";
				if($conn->query($sql3))
				{
					echo "<h2>Your membership has been terminated</h2>";
	    			echo "<a href=\"../homepage.html\" class=\"button\">Back</a>";
					session_destroy();
				}
				else
				{
					echo "<h2>Error</h2><p>".$conn->error."</p>";
    				echo "<a href=\"memberdashboard.html\" class=\"button\">Back</a>";
				}
			}
			else
			{
				echo "<h2>Books Due</h2><p>Please return all the books before requesting deactivation</p>";
    			echo "<a href=\"memberdashboard.html\" class=\"button\">Back</a>";
			}
	}

	else
	{
		echo "<h2>Wrong Passkey. Re-enter</h2>";
	    echo "<a href=\"m_deactivate.html\" class=\"button\">Back</a>";
	}

	$conn->close();
?>
		    </div>
		</div>	
</body>
</html>