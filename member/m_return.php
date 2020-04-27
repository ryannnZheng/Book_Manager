<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Return Books</title>
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
					$q3="SELECT * FROM BORROWED where BID='$bid' and MID='$mid';";
					$q4="UPDATE MEMBER SET num_borrowed=(num_borrowed+1) WHERE MID='$mid';";
					$q5="DELETE FROM BORROWED WHERE BID='$bid' AND MID='$mid';";
					$r3=$conn->query($q3);

					if($r3->num_rows>0)
					{
						$r4=$conn->query($q4);
						$r5=$conn->query($q5);
						if($r4&&$r5)
						{
							echo "<h2>Book Returned Successfully</h2>";
							echo "<a href=\"memberdashboard.html\" class=\"button\">Dashboard</a>";
						}
					

						else
						{
							echo "<h2>Error</h2><p>".$conn->error."</p>";
							echo "<a href=\"m_return.html\" class=\"button\">Back</a>";
						}
					}
					else
					{
						echo "<h2>You have not borrowed this book</h2>";
						echo "<a href=\"m_return.html\" class=\"button\">Back</a>";
					}
				}

				else
				{
					echo "<h2>Invalid BID</h2>";
					echo "<a href=\"m_return.html\" class=\"button\">Back</a>";
				}
			}
			else
			{
				echo "<h2>Wrong Passkey. Re-enter</h2>";
				echo "<a href=\"m_return.html\" class=\"button\">Back</a>";
			}

			
    		$conn->close();
?>

		    </div>
		</div>	
</body>
</html>
