<?php 
	session_start();
	$conn=new mysqli("localhost","root","","library");
	error_reporting(0);
	$_SESSION['aid']=$_POST['id'];
	$aid=$_SESSION['aid'];
	$pwd=$_POST['passkey'];
	$sql1="SELECT * FROM librarian WHERE LID = '$aid' AND passkey='$pwd';";
	$result = mysqli_query($conn,$sql1);

	if($result->num_rows>0)
	{
			header('Location: '.'admindashboard.html');
	}

	else
	{
			//echo "<script>alert('wrong id or password')</script>";
			session_destroy();
			header('Location: '.'adminlogin.html');
	}
?>