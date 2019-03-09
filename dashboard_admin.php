<?php
	require_once('user_model.php');
	require_once('controller.php');
	session_start();
	
	
	//$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	if (!isset($_SESSION['user']))
	{
		header("Location:login.php");
	}
	else
	{
		//fwrite($myfile, $_SESSION['user']->name);
		$user = $_SESSION['user'];
	}
	$controller = new Controller();
	//fclose($myfile);
	include 'sidebar.php';
?>
<html>
<head>
</head>
<body>
<div style="margin-left:20%;padding:1px 16px;height:1000px;">
<p>
	<?php
		echo 'My username is:';
		print $user->get_username();
		?>
</p>
<br \>
<p>
<?php
	$monthTotalSale = $controller->getTotalSales();
	echo 'Month total sale: '.$monthTotalSale['MonthTotalSale'].' euros';
?>
</p>
<br />
<p>
<?php
	$stmt = $controller->getBestSalers();
	echo "Best salers: <br />";
	while($row = $stmt->fetch())
	{
		echo "Name: ".$row['name']. ", Username: ".$row['username'];
		echo "<br />";
	} 
?>
</p>
<br />
<p>
	<a href = "index.php?operation=logout">Logout</a>
</p>
</div>
</body>
</html>