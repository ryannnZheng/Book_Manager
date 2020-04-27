<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Register</title>
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
			error_reporting(0);
			$conn = new mysqli("localhost","root","","library");
			
			$mid=$_POST['mid'];
			$fname=$_POST['fname'];
			$address=$_POST['address'];
			$dob=$_POST['dob'];
			$pwd=$_POST['passkey'];

			$sql="INSERT INTO MEMBER(name,address,dob,MID,passkey) VALUES ('$fname','$address','$dob','$mid','$pwd');";

			echo "<section id=\"main\" class=\"wrapper\">";
			
			if (mysqli_query($conn,$sql)) 
			{
				$q1="UPDATE MEMBER set num_borrowed=5 where MID='$mid';";
    			$r1=$conn->query($q1);
    			echo "<h2>Registration Successful</h2>";
    			
    			$sql="SELECT MID, name, address, dob, mtype, passkey, num_borrowed FROM MEMBER where MID=$mid";
				$result = $conn->query($sql);

				if ($result->num_rows>0) 
				{
    				echo "<div><table border=1 ><tr><th>ID</th><th>Name</th><th>Address</th><th>DOB</th><th>Passkey</th><th>Borrow Limit</th></tr>";
	  
	    			while($row = $result->fetch_assoc()) 
	    			{
	        			echo "<tr><td>".$row['MID']."</td><td>".$row['name']."</td><td>".$row['address']."</td><td>".$row['dob']."</td><td>".$row['passkey']."</td><td>".$row['num_borrowed']."</td></tr>";
	    			}	
	    		
	    			echo "</table></div>";
	    			echo "<a href=\"../login.html\" class=\"button\">Continue to Login</a>";
				} 
				else 
				{
	    			echo "<h2>Zero Results</h2>";
	    		}
			} 
			
			else 
			{
    			echo "<h2>Error</h2><p>".$conn->error."</p>";
			}

			
    	
    		$conn->close();
?>

		    </div>
		</div>	
</body>
</html>
