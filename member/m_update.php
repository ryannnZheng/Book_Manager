<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Details Updated</title>
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
			$fname=$_POST['fname'];
			$address=$_POST['address'];
			$dob=$_POST['dob'];
			$pwd=$_POST['passkey'];
			
			$q="SELECT * FROM BORROWED where MID='$mid';";
			$res=$conn->query($q);
			$nb=$res->num_rows;

			$sql= "UPDATE MEMBER SET name='$fname', address='$address', dob='$dob', passkey='$pwd', mtype='$type' WHERE MID=$mid";

			if ($conn->query($sql)) 
			{
				$q1="UPDATE MEMBER set num_borrowed=5-$nb where MID='$mid';";

    			$r1=$conn->query($q1);
    			echo "<h2>Your Details Are Updated</h2>";
    			
    			$sql="SELECT MID, name, address, dob, mtype, passkey, num_borrowed FROM MEMBER where MID=$mid";
				$result = $conn->query($sql);

				if ($result->num_rows>0) 
				{
    				echo "<div class=\"table-wrapper\"><table class=\"alt\" border=1 ><tr><th>ID</th><th>Name</th><th>Address</th><th>DOB</th><th>Membership Type</th><th>Passkey</th><th>Current Borrow Limit</th></tr>";
	    			
	    			while($row = $result->fetch_assoc()) 
	    			{
	        			echo "<tr><td>".$row['MID']."</td><td>".$row['name']."</td><td>".$row['address']."</td><td>".$row['dob']."</td><td>".$row['mtype']."</td><td>".$row['passkey']."</td><td>".$row['num_borrowed']."</td></tr>";
	    			}	
	    		
	    			echo "</table></div>";
	    			echo "<a href=\"memberdashboard.html\" class=\"button\">Dashboard</a>";
				} 
				else 
				{
	    			echo "<h2>Zero Results</h2>";
					echo "<a href=\"memberdashboard.html\" class=\"button\">Dashboard</a>";
	    		}

			} 
			else 
			{
    			echo "<h2>Error</h2><p>".$conn->error."</p>";
				echo "<a href=\"memberdashboard.html\" class=\"button\">Dashboard</a>";
			}

		
    	
    		$conn->close();
?>

		    </div>
		</div>	
</body>
</html>

