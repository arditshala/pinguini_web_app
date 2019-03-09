<?php
	require_once('user_model.php');
	
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
	//fclose($myfile);
	include 'sidebar.php';
?>

<html>
<head>
	<title>Pinguini DB</title>
	<link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>

<style>
p {
	color: black;
}

.form-style-9{
	max-width: 450px;
	background: #FAFAFA;
	padding: 30px;
	margin: 50px auto;
	box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
	border-radius: 10px;
	border: 6px solid #EE7624;
	float: left;
	width: 400px;
}

.form-style-8{
	max-width: 450px;
	background: #FAFAFA;
	padding: 30px;
	margin: 50px auto;
	box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
	border-radius: 10px;
	border: 6px solid #EE7624;
	float: left;
	width: 400px;
}

h4 { 
  display: block;
  font-size: 1em;
  margin-top: 1.33em;
  margin-bottom: 1.33em;
  margin-left: 0;
  margin-right: 0;
  font-weight: bold;
  color: black;
}

h3 { 
  font-size: 1.17em;
  margin-top: 1em;
  margin-bottom: 1em;
  margin-left: 0;
  margin-right: 0;
  font-weight: bold;
  color: orange;
  float: right;
}

.form-style-9 ul li{
	margin-bottom: 10px;
	min-height: 20px;
	background: #cce5ff;
}

</style>

<div style="margin-left:20%;padding:1px 16px;height:1000px;">
        <h1 align="middle" > Paneli i Përdoruesit </h1>
	

	<div class = "form-style-8" style="margin-left:10%">
		<p>
			I am logged in. This is the dashboard.
		<br \>
			<?php
			echo 'I am ';
			print $user->get_username();
			?>
		<br \>
		<?php
			echo "I am in the dashboard!";
		?>
		<a href = "index.php?operation=logout">Logout</a>
		</p>
	</div>

	<div class = "form-style-9" style="margin-left:10%">
		<ul> 
			<li> 
				<h4> Total daily sales: <!-- insert PHP --></h4> <h3>€ 3434.43</h3>
			</li> 
			<li> 
				<h4> Total month sales: <!-- insert PHP --> €</h4>  
			</li> 
			<li> 
				<h4> Total num. of orders: <!-- insert PHP --> </h4>  
			</li> 
			<li> 
				<h4> Average sales per day: <!-- insert PHP --> €</h4> 
			</li> 
			<li> 
				<h4> Total bonus of the month: <!-- insert PHP --> €</h4>
			</li>  
		</ul>  
	</div>
</div>

</html>