<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Update Admin</title>
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
			$pass=$_POST['pwd'];

			$lid=$_POST['lid'];
			$fname=$_POST['fname'];
			$dob=$_POST['dob'];
			$pwd=$_POST['passkey'];
			
			$q1="SELECT * FROM librarian where LID='$aid' and passkey='$pass';";
			$result = mysqli_query($conn,$q1);

			

			if($result->num_rows>0)
			{
				$q2="SELECT * FROM librarian where LID='$lid';";
				$res= mysqli_query($conn,$q2);

				if($res->num_rows>0)
				{
					$sql="UPDATE librarian set name='$fname',DOB='$dob',passkey='$pwd' WHERE LID='$lid';";
					
					if (mysqli_query($conn,$sql)) 
					{
    					echo "<h2>Admin Details Updated</h2>";
    			
		    			$sql1="SELECT LID, name, DOB, salary, passkey FROM librarian where LID='$lid'";

						$result1 = $conn->query($sql1);

						if ($result1->num_rows>0) 
						{
		    				echo "<div><table border=1 ><tr><th>ID</th><th>Name</th><th>DOB</th><th>Salary</th><th>Passkey</th></tr>";
			    		
			    			while($row = $result1->fetch_assoc()) 
			    			{
			        			echo "<tr><td>".$row['LID']."</td><td>".$row['name']."</td><td>".$row['DOB']."</td><td>".$row['salary']."</td><td>".$row['passkey']."</td></tr>";
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
	    			echo "<h2>Invalid LID</h2>";
	    			echo "<a href=\"admindashboard.html\" class=\"button\">Dashboard</a>";
	    		}

			}
			else
			{
				echo "<h2>Wrong Passkey. Re-enter</h2>";
				echo "<a href=\"admindashboard.html\" class=\"button\">Dashboard</a>";
			}
    	

    		$conn->close();
?>

		</div>
	</div>
</body>
</html>
