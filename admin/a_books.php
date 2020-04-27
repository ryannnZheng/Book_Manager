<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>View All Books</title>
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

			$sql="SELECT BID,bname,author,genre,LID,BOOK.PID,pname FROM BOOK INNER JOIN PUBLISHER ON BOOK.PID=PUBLISHER.PID ORDER BY bname;";
			$result=$conn->query($sql);

			if ($result) 
			{
				if ($result->num_rows>0) 
				{	
					echo "<h2>All Books</h2>";
    				echo "<div><table border=1 ><tr><th>BID</th><th>Name</th><th>Author</th><th>Genre</th><th>Publisher Name</th><th>PID</th><th>LID</th></tr>";

	    			while($row = $result->fetch_assoc()) 
	    			{
	    				echo "<a>";
	        			echo "<tr><td>".$row['BID']."</td><td>".$row['bname']."</td><td>".$row['author']."</td><td>".$row['genre']."</td><td>".$row['pname']."</td><td>".$row['PID']."</td><td>".$row['LID']."</td></tr>";
	        			echo "</a>";
	    			}	
	    		
	    			echo "</table></div>";
					echo "<a href=\"admindashboard.html\" class=\"button\">Back</a>";
				} 
				else 
				{
	    			echo "<h2>Zero Results</h2>";
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
