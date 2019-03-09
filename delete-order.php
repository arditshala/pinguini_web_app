<?php
session_start();
	if (!isset($_SESSION['user']))
	{
		header("Location:login.php");
	}
	else
	{
		$user = $_SESSION['user'];
	}
?>
<html>
<head></head>
<body>
I am in Delete-order!
</body>
</html>