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

			$sql="SELECT MEMBER.MID,name,BOOK.BID,bname FROM MEMBER,BOOK,BORROWED WHERE BOOK.BID=BORROWED.BID and BORROWED.MID=MEMBER.MID ORDER BY name,bname;";
			$result=$conn->query($sql);

			if ($result) 
			{
    			if ($result->num_rows>0) 
				{		
						echo "<h2>All Borrowed Books</h2>";
						echo "<div><table border=1 ><tr><th>MID</th><th>Member Name</th><th>BID</th><th>Book Name</th></tr>";

	    			while($row = $result->fetch_assoc()) 
	    			{
	    				echo "<tr><td>".$row['MID']."</td><td>".$row['name']."</td><td>".$row['BID']."</td><td>".$row['bname']."</td></tr>";
	    			}	
	    		
	    			echo "</table></div>";
					echo "<a href=\"admindashboard.html\" class=\"button\">Dashboard</a>";
				} 
				else 
				{
	    			echo "<h2>No Books Borrowed</h2>";
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
