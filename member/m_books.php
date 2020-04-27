<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Browse Books</title>
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
			error_reporting(0);
			$conn = new mysqli("localhost","root","","library");
			//$sql = "SELECT BOOK.BID,bname,author,genre,format,LID,BOOK.PID,pname FROM BOOK,PUBLISHER,BORROWED WHERE BOOK.PID=PUBLISHER.PID AND BOOK.BID!=BORROWED.BID ORDER BY bname;"
			//$SERCH = "SELECT BOOK.BID,bname,author,genre,format,LID,PID FROM BOOK,BORROWED WHERE BOOK.BID!=BORROWED.BID ORDER BY bname;"
			//$sql = "SELECT BID,bname,author,genre,format,LID,SERCH.PID,pname FROM SERCH,PUBLISHER WHERE SERCH.PID=PUBLISHER.PID ORDER BY bname;"
			//$sql="SELECT BID,bname,author,genre,format,LID,BOOK.PID,pname FROM BOOK,PUBLISHER WHERE BOOK.PID=PUBLISHER.PID ORDER BY bname;";
			
			$sql="SELECT BOOK.BID,bname,author,genre,LID,PID FROM BOOK,BORROWED WHERE BOOK.BID!=BORROWED.BID ORDER BY bname;";
			$result=$conn->query($sql);

	
			if ($result) 
			{
    			echo "<h2>Books Available</h2>";

				if ($result->num_rows>0) 
				{
    				echo "<div><table border=1 ><tr><th>BID</th><th>Name</th><th>Author</th><th>Genre</th><th>PID</th><th>LID</th></tr>";
	    		

	    			while($row = $result->fetch_assoc()) 
	    			{
	    				echo "<a>";
	        			echo "<tr><td>".$row['BID']."</td><td>".$row['bname']."</td><td>".$row['author']."</td><td>".$row['genre']."</td><td>".$row['PID']."</td><td>".$row['LID']."</td></tr>";
	        			echo "</a>";
	    			}	
	    		
	    			echo "</table></div>";
					echo "<a href=\"memberdashboard.html\" class=\"button\">Back</a>";
				} 
				else 
				{
	    			echo "<h2>Zero Results</h2>";
					echo "<a href=\"memberdashboard.html\" class=\"button\">Back</a>";
	    		}

			} 
			else 
			{
    			echo "<h2>Error</h2><p>".$conn->error."</p>";
				echo "<a href=\"memberdashboard.html\" class=\"button\">Back</a>";
			}

			
    	
    		$conn->close();
?>

		    </div>
		</div>	
</body>
</html>
