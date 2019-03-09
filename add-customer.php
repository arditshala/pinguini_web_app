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

<div style="margin-left:17%;padding:1px 16px;height:100%;">
        <h1 align="middle" > Add a Customer </h1>
        <form class = "form-style-9" method="POST" action="index.php">
        <ul>
		<li>
			<input type="text" name="customer_name" class="field-style field-split align-left" placeholder="Name"/>
			<input type="text" name="customer_surname" class="field-style field-split align-right" placeholder="Surname"/>
		</li>
        <li>
            <input type="int" name="customer_age" class="field-style field-split align-left" placeholder="Age"/>
            <input type="text" name="customer_phone" class="field-style field-split align-right" placeholder="Phone Number"/>
        </li>
        <li>
			<input type="text" name="customer_address" class="field-style field-full" placeholder="Street and House No."/>
		</li>
        <li>
            <input type="text" name="customer_city" class="field-style field-split align-left" placeholder="City"/>
            <input type="text" name="customer_country" class="field-style field-split align-right" placeholder="Country"/>
        </li>
        <li>
		</li>
        <li>
			<input type="submit" name="operation" value="Add customer"/>
		</li>
	
        </ul>
        </form>
</div>

<?php 
                if(@$_GET['succ'] == 1)
                { ?>
                     <!-- <p align="middle" style="background-color: #AEF359"> Thank you, the information was successfully stored! </p> -->
					<script type='text/javascript'>alert('Customer succesfully added!')</script>
			 	<?php } ?>
			  
			  <?php 
                if(@$_GET['err'] == 1)
                { ?>
                    <!-- <p align="middle" style="background-color: #F778AI"> This supplier is already existent in the database! </p> -->
					<script type='text/javascript'>alert('There was a mistake, please add the costumer again!')</script>
              <?php } ?>

</html>