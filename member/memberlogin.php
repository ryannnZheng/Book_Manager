<?php 
	session_start();
	$conn=new mysqli("localhost","root","","library");
	//$con = mysql_connect("localhost","root","");
	error_reporting(0);
	$_SESSION['mid']=$_POST['id'];
	$mid=$_SESSION['mid'];
	$pwd=$_POST['passkey'];
	$sql1="SELECT * FROM member WHERE MID = '$mid' AND passkey='$pwd';";
	$result = mysqli_query($conn,$sql1);

	echo "<center>";
	echo "<section id=\"main\" class=\"wrapper\">";
	if($result->num_rows>0)
	{
		header('Location: '.'memberdashboard.html');
	}

	else
	{
		session_destroy();
		header('Location: '.'memberlogin.html');
	}
	
?>
		