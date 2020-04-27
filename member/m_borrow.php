<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Borrow Books</title>
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
			$bid=$_POST['bid'];
			$pwd=$_POST['passkey'];

			$q1="SELECT * FROM MEMBER WHERE MID='$mid' and passkey='$pwd';";

			$r1=$conn->query($q1);
			

			if($r1->num_rows>0)
			{
				$q2="SELECT * FROM BOOK WHERE BID='$bid';";
				$r2=$conn->query($q2);

				if($r2->num_rows>0)
				{
					$q5="SELECT num_borrowed FROM MEMBER where MID='$mid';";
					$r5=$conn->query($q5);
					$roww=$r5->fetch_assoc();

					if($roww['num_borrowed']>0)
					{

						$q3="INSERT INTO BORROWED(MID,BID) values ('$mid','$bid');";
						$q4="UPDATE MEMBER SET num_borrowed=(num_borrowed-1) WHERE MID='$mid';";
						$r3=$conn->query($q3);

						if($r3)
						{
							$r4=$conn->query($q4);

							if($r4)
							{
								echo "<h2>Book Borrowed Succesfully</h2>";
								echo "<a href=\"memberdashboard.html\" class=\"button\">Back</a>";
							}
							else
							{
								echo "<h2>Error</h2><p>".$conn->error."</p>";
								echo "<a href=\"memberdashboard.html\" class=\"button\">Back</a>";
							}
						}

						else
						{
							echo "<h2>Error</h2><p>".$conn->error."</p>";
							echo "<a href=\"memberdashboard.html\" class=\"button\">Back</a>";
						}
					}
					else
					{
						echo "<h2>Borrowing Limit Reached</h2><p>Please return currently borrowed books before borrowing more</p>";
						echo "<a href=\"memberdashboard.html\" class=\"button\">Back</a>";
					}
				}
				else
				{
					echo "<h2>Book Does Not Exist</h2>";
					echo "<a href=\"m_borrow.html\" class=\"button\">Back</a>";
				}
			}
			else
			{
				echo "<h2>Wrong Passkey. Re-enter</h2>";
				echo "<a href=\"m_borrow.html\" class=\"button\">Back</a>";
			}
		
    		$conn->close();
?>
		    </div>
		</div>	
</body>
</html>