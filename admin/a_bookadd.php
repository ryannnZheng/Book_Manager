<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Add Book</title>
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
			$aid=$_SESSION['aid'];
			
			$bid=$_POST['bid'];
			$bname=$_POST['bname'];
			$author=$_POST['author'];
			$genre=$_POST['genre'];
			
			$pname=$_POST['pname'];
			$pid=$_POST['pid'];

		
			$sql= "INSERT INTO BOOK(bname,author,genre,BID,LID,PID) VALUES ('$bname','$author','$genre','$bid','$aid','$pid');";
			$sql2= "INSERT INTO PUBLISHER(PID,pname) VALUES ('$pid','$pname');";

			echo "<div class=\"container\">";

			if (mysqli_query($conn,$sql)) 
			{
				$r=$conn->query($sql2);

	    		echo "<h2>Book Added Succesfully</h2>";
				
				$sql3="SELECT B.BID, B.bname, B.author, B.genre,P.pname FROM BOOK B, PUBLISHER P where BID='$bid' and B.PID=P.PID";
				$result = $conn->query($sql3);
				
				if ($result->num_rows>0) 
				{
	    			echo "<a href=\"admindashboard.html\" class=\"button\">Dashboard</a>";
				} 
				else 
				{
	    			echo "<h2>Zero Results</h2>";
	    			echo "<a href=\"admindashboard.html\" class=\"button\">Dashboard</a>";
	    		}
			} 

			else 
			{
    			echo "<h2>Error</h2><p>".$conn->error."</p>";
    			echo "<a href=\"admindashboard.html\" class=\"button\">Dashboard</a>";
			}
    		

    		$conn->close();
  ?>

		</div>
	</div>
</body>
</html>
