<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Delete Book</title>
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

	$bid=$_POST['bid'];
	$aid=$_SESSION['aid'];
	$pwd=$_POST['passkey'];

	$sql="SELECT * FROM librarian WHERE LID='$aid' AND passkey='$pwd';";
	$result = mysqli_query($conn,$sql);
	
	if($result->num_rows>0)
	{
			$sql1="SELECT * FROM BOOK WHERE BID='$bid';";
			$res=mysqli_query($conn,$sql1);

			if($res->num_rows>0)
			{
				$sql2="DELETE FROM BOOK WHERE BID='$bid';";

				if($conn->query($sql2))
				{
					echo "<h2>Book Deleted</h2>";
	    			echo "<a href=\"admindashboard.html\" class=\"button\">Dashboard</a>";
				}
				else
				{
					echo "<h2>Error</h2><p>".$conn->error."</p>";
    				echo "<a href=\"admindashboard.html\" class=\"button\">Dashboard</a>";
				}
			}
			else
			{
				echo "<h2>Invalid BID</h2>";
    			echo "<a href=\"admindashboard.html\" class=\"button\">Dashboard</a>";
			}
	}

	else
	{
		echo "<h2>Wrong Passkey. Re-enter</h2>";
	    echo "<a href=\"a_bookdelete.html\" class=\"button\">Back</a>";
	}

	$conn->close();
?>
		</div>
	</div>
</body>
</html>
