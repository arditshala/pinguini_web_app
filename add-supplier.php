<?php
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
    
body {
    background-color: #ffffff
}
</style>

<div style="margin-left:17%;padding:1px 16px;height:1000px;">
	<h1 align="middle" > Add a supplier </h1>
	<form class = "form-style-9" method="POST" action="index.php">
		<ul>
		<li>
			<input type="text" name="supplier_name" class="field-style field-split align-left" placeholder="Company name"/>
			<input type="text" name="supplier_email" class="field-style field-split align-right" placeholder="E-mail address"/>
		</li>
		<li>
			<textarea name="supplier_address" class="field-style" placeholder="Company's full address"></textarea>
		</li>
		<li>
			<input type="text" name="supplier_phone" class="field-style field-split align-left" placeholder="Phone"/>
			<input type="text" name="supplier_country" class="field-style field-split align-right" placeholder="Country"/>
		</li> 
		<li>
			<input type="text" name="supplier_agg_number" class="field-style field-full" placeholder="Aggrement Number2"/>
		</li>
		<li>
			<div id="element1">
			<p> Is the supplier a manufacturer? </p>
			</div>
			<div id="element2">
			<input type="radio" name="supplier_radio" value="1" class="radio" id="one"/>
			<label for="one"> Yes </label>
			<input type="radio" name="supplier_radio" value="0" class="radio" id="two" />
			<label for="two"> No </label> 
			</div>
		</li>
		<li>
		</li>
		<li>
			<input type="submit" name="operation" value="Add supplier"/>
		</li>
		</ul>
	</form>

	<?php 
                if(@$_GET['succ'] == 1)
                { ?>
                     <!-- <p align="middle" style="background-color: #AEF359"> Thank you, the information was successfully stored! </p> -->
					<script type='text/javascript'>alert('Supplier succesfully added!')</script>
			 	<?php } ?>
			  
			  <?php 
                if(@$_GET['err'] == 1)
                { ?>
                    <!-- <p align="middle" style="background-color: #F778AI"> This supplier is already existent in the database! </p> -->
					<script type='text/javascript'>alert('There was a mistake, please add the supplier again!')</script>
              <?php } ?>
			
</div>
</html>