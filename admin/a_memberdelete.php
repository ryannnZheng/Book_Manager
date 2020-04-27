<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Remove Member</title>
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
	$conn=new mysqli("localhost","root","","library");
	error_reporting(0);

	$aid=$_SESSION['aid'];
	$pwd=$_POST['passkey'];
	$mid=$_POST['mid'];

	$sql="SELECT * FROM LIBRARIAN WHERE LID = '$aid' AND passkey='$pwd';";
	$result = mysqli_query($conn,$sql);

	echo "<section id=\"main\" class=\"wrapper\">";

	if($result->num_rows>0)
	{
		$qq="SELECT * from Member where MID='$mid';";
		$rr=$conn->query($qq);

		if($rr->num_rows>0)
		{
			$nb = 5;
			$sql2="SELECT * FROM MEMBER WHERE MID='$mid' AND num_borrowed=$nb;";
			$result=$conn->query($sql2);

			if($result->num_rows>0)
			{
				$sql3="DELETE FROM MEMBER WHERE MID='$mid';";
				if($conn->query($sql3))
				{
					echo "<header class=\"major\"><h2>Member Removed</h2></header>";
					echo "<a href=\"admindashboard.html\" class=\"button\">Back</a>";
	    		
				}
				else
				{
					echo "<h2>Error</h2><p>".$conn->error."</p>";
					echo "<a href=\"admindashboard.html\" class=\"button\">Back</a>";
    		
				}
			}
			else
			{
				echo "<h2>Books Due</h2><p>Member has not returned all the books. Please try again after all books have been returned</p>";
				echo "<a href=\"admindashboard.html\" class=\"button\">Back</a>";
			}
		}
		else
		{
			echo "<h2>logout</h2>";
			echo "<a href=\"../homepage.html\" class=\"button\">Back</a>";
		}
	}

	else
	{
		echo "<h2>Invalid Passkey. Try Again</h2>";
		echo "<a href=\"a_memberdelete.html\" class=\"button\">Back</a>";
	}

	$conn->close();
?>
		</div>
	</div>
</body>
</html>
