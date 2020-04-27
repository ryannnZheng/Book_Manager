<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Book Updated</title>
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
			$bid=$_POST['BID'];
			
			$bname=$_POST['bname'];
			$author=$_POST['author'];
			$genre=$_POST['genre'];
			
			$pname=$_POST['pname'];
			$pid=$_POST['pid'];

		
			$q="SELECT * FROM BOOK where BID='$bid';";
			$r=$conn->query($q);

			$q1="SELECT * FROM publisher where PID='$pid';";
			$r1=$conn->query($q1);

			echo "<div class=\"container\">";
			if($r->num_rows>0)
			{
				$sql= "UPDATE BOOK SET bname='$bname',author='$author', genre='$genre',LID='$aid',PID='$pid' WHERE BID='$bid';";

				if (mysqli_query($conn,$sql)) 
				{
	    			echo "<h2>Book Updated Succesfully</h2>";

	    			if($r1->num_rows>0)
	    			{
	    				$sql3= "UPDATE PUBLISHER SET pname='$pname' where PID='$pid';";
	    				$r3=$conn->query($sql3);
	    			}
	    			else
	    			{
	    				$sql3= "INSERT INTO PUBLISHER(pname,PID) VALUES ('$pname','$pid');";
	    				$r3=$conn->query($sql3);
	    			}

	    			$qry="SELECT BID, bname, author, genre, format,pname FROM BOOK,PUBLISHER where BID='$bid' and BOOK.PID=PUBLISHER.PID;";
					$result= $conn->query($qry);

					if ($result->num_rows>0) 
					{
	    				echo "<div><table border=1 ><tr><th>ID</th><th>Name</th><th>Author</th><th>Genre</th><th>Format</th><th>Publisher</th></tr>";

		    			while($row = $result->fetch_assoc()) 
		    			{
		        			echo "<tr><td>".$row['BID']."</td><td>".$row['bname']."</td><td>".$row['author']."</td><td>".$row['genre']."</td><td>".$row['format']."</td><td>".$row['pname']."</td></tr>";
		    			}	
		    		
		    			echo "</table></div>";
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
    		}

    		else
    		{
    			echo "<h2>Book does not exist</h2>";
    			echo "<a href=\"admindashboard.html\" class=\"button\">Dashboard</a>";
    		}
    		echo "</section>";
    		$conn->close();
  ?>
		</div>
	</div>
</body>
</html>
