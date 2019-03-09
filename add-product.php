<?php
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
	//fclose($myfile);
	$controller = new Controller();
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

#myDIV1 {
    width: 100%;
    padding: 15px 0;
    text-align: center;
    background-color: #EBF5FB;
    margin-top: 10px;
    display: none;
}
#myDIV2 {
    width: 100%;
    padding: 15px 0;
    text-align: center;
    background-color: #EBF5FB;
    margin-top: 10px;
    display: none;
}
</style>

<div style="margin-left:17%;padding:1px 16px;height:1000px;">
        <h1 align="middle" > Add a Product </h1>
        <form class = "form-style-9" method="POST" action="index.php">
        <ul>
		<li>
			<input type="text" name="product_name" class="field-style field-split align-left" placeholder="Product Name"/>
			<input type="number" name="product_price" class="field-style field-split align-right" placeholder="Price per Unit"/>
		</li>
        <li>
            <input type="number" name="product_stock" class="field-style field-split align-left" placeholder="Stock QTY"/>
			<input type="text" name="product_code" class="field-style field-split align-right" placeholder="6-digit code"/>
        </li>
        <li>
            <input type="number" name="product_warranty" class="field-style field-split align-left" placeholder="Warranty Duration(years)"/>
			<input type="number" name="product_costums" class="field-style field-split align-right" placeholder="HS Code"/>
        </li>
        <li>
			<?php
				$suppliers = $controller->getAllSuppliers();
				echo '<select name="company_select" id="company_select" class="field-style field-full">';
				echo '<option value="" disabled selected>Select the supplier for this product</option>';
				foreach ($suppliers as $supplier)
				{
					echo '<option value="'.$supplier['name'].'">'.$supplier['name'].'</option>';
				}
				echo '</select>';
			?>
        </li>
        <li>
        <textarea name="product_description" class="field-style" placeholder="Product short description"></textarea>
        </li>
        <li>
        <div id="element1">
            <button type="button" onclick="myFunction(1)">Cosmetics/Health Product?</button> 
        </div>
        <div id="element2">
            <button type="button" onclick="myFunction(2)">Electronic Product?</button>
        </div>
        </li>
        <li>
            <div id="myDIV1">
                <div id="element1">
                    <p> Write the date of expiration: </p>
                </div> 
                <div id="element2">
                    <input type="date" name="product_date" class="field-style" placeholder="Expiring Date"/>
                </div>
                <p> </p>
                <div id="element1">
			    <p> Is the product described ? </p>
			    </div>
			    <div id="element2">
			    <input type="radio" name="product_radio" value="1" class="radio" id="one"/>
			    <label for="one"> Yes </label>
			    <input type="radio" name="product_radio" value="0" class="radio" id="two" />
			    <label for="two"> No </label> 
			    </div>
            </div>
            <div id="myDIV2">
                <div id="element1">
			    <p> Is the product tested ? </p>
			    </div>
			    <div id="element2">
			    <input type="radio" name="product_radio2" value="1" class="radio" id="one"/>
			    <label for="one"> Yes </label>
			    <input type="radio" name="product_radio2" value="0" class="radio" id="two" />
			    <label for="two"> No </label> 
			    </div>

                <div id="element1">
                    <input type="number" name="product_temp" class="field-style field-split align-left" placeholder="Temperature Cond."/>
                    <input type="number" name="product_fragile" class="field-style field-split align-right" placeholder="Fragile Level"/>
                </div> 
            </div>
        </li>
        <li>
			<input type="submit" name="operation" value="Add product"/>
        </li>
        </ul>
</div>

<?php 
                if(@$_GET['succ'] == 1)
                { ?>
                     <!-- <p align="middle" style="background-color: #AEF359"> Thank you, the information was successfully stored! </p> -->
					<script type='text/javascript'>alert('Product succesfully added!')</script>
			 	<?php } ?>
			  
			  <?php 
                if(@$_GET['err'] == 1)
                { ?>
                    <!-- <p align="middle" style="background-color: #F778AI"> This supplier is already existent in the database! </p> -->
					<script type='text/javascript'>alert('There was a mistake, please add the product again!')</script>
              <?php } ?>

<script>
function myFunction(z) {
  var x;
  var y;
 switch(z)
    {
    case 1: x = document.getElementById("myDIV1"); y = document.getElementById("myDIV2"); break;
    case 2: x = document.getElementById("myDIV2"); y = document.getElementById("myDIV1"); break;
    }
   
    if (x.style.display === "none") {
        x.style.display = "block";
        y.style.display = "none";
    } else {
        x.style.display = "none";
    }
}
</script>
</html>