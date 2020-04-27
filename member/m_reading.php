<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Borrowed Books</title>
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
			$mid=$_SESSION['mid'];

			$sql="SELECT BOOK.BID,bname,author,genre FROM BOOK,BORROWED WHERE BOOK.BID=BORROWED.BID and BORROWED.MID='$mid' ORDER BY bname;";
			$result=$conn->query($sql);

			$q="SELECT * FROM MEMBER WHERE MID='$mid';";
			$r=$conn->query($q);
			$roww=$r->fetch_assoc();

			if ($result) 
			{

				if ($result->num_rows>0) 
				{
					echo "<header class=\"major\"><h2>Currently Borrowed</h2><p>Number of books till borrow limit: ".$roww['num_borrowed']."</p></header>";
    				echo "<div class=\"table-wrapper\"><table class=\"alt\" border=1 ><tr><th>BID</th><th>Name</th><th>Author</th><th>Genre</th></tr>";
	    			// output data of each row
    				
	    			while($row = $result->fetch_assoc()) 
	    			{
	    				echo "<a>";
	        			echo "<tr><td>".$row['BID']."</td><td>".$row['bname']."</td><td>".$row['author']."</td><td>".$row['genre']."</td></tr>";
	        			echo "</a>";
	    			}	
	    		
	    			echo "</table></div>";
	    			echo "<a href=\"memberdashboard.html\" class=\"button\">Back</a>";
				} 
				else 
				{
	    			echo "<h2>You have not borrowed any books</h2>";
	    			echo "<a href=\"memberdashboard.html\" class=\"button\">Back</a><";
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
