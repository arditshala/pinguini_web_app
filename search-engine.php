<?php
	//require_once('controller.php');
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

.hidden {
  display: none;
} 
</style>

<div style="margin-left:20%;padding:1px 16px;height:100%;">
        <h1 align="middle" > Search Panel </h1>
        <div class = "form-style-9">
        <ul> 
        <li> 
            <p align="middle"> Select what do you want to search for </p>
        </li> 
        <li> 
        <select name="questions" id="faq-questions" class="field-style field-full">
        <option value="" disabled selected> Select the type of search </option>  
        <option value="1">Search for Employee's revenue</option>
        <option value="2">Search for a Product</option> 
        <option value="3">Search for a Supplier</option> 
        <option value="4">Search for a Costumer</option> 
        <option value="5">Search the shipping company by trackingID</option> 
        <option value="6">Search all products whith a fragile level</option>
        </select>
    
        <div class="answer hidden" id="answer1">
            <form class = "form-style-9" method="POST" action="index.php">
            <ul> 
            <li> 
                <input type="text" name="employee_name" class="field-style field-full" placeholder="The name of the employee"/>
            </li> 
            <li> 
                <input type="submit" name="operation" value="Search Employee"/>
            </li> 
            </ul>
            </form>
        </div> 
            
    
        <div class="answer hidden" id="answer2">
            <form class = "form-style-9" method="POST" action="index.php">
            <ul> 
            <li> 
                <input type="text" name="product_name" class="field-style field-full" placeholder="The name of the product"/>
            </li> 
            <li> 
                <input type="submit" name="operation" value="Search product"/>
            </li> 
            </ul>
            </form>
        </div> 
    
        <div class="answer hidden" id="answer3">
        <form class = "form-style-9" method="POST" action="index.php">
            <ul> 
            <li> 
                <input type="text" name="supplier_name" class="field-style field-full" placeholder="The name of the supplier"/>
            </li> 
            <li> 
                <input type="submit" name="operation" value="Search supplier"/>
            </li> 
            </ul>
            </form>
        </div> 
		
        <div class="answer hidden" id="answer4">
            <form class = "form-style-9" method="POST" action="index.php">
            <ul> 
            <li> 
                <input type="text" name="customer_name" class="field-style field-full" placeholder="The name of the customer"/>
            </li> 
            <li> 
                <input type="submit" name="operation" value="Search customer"/>
            </li> 
            </ul>
            </form>
        </div> 
    
        <div class="answer hidden" id="answer5">
            <form class = "form-style-9" method="POST" action="index.php">
            <ul> 
            <li> 
                <input type="text" name="tracking_id" class="field-style field-full" placeholder="Write the trackingID"/>
            </li> 
            <li> 
                <input type="submit" name="operation" value="Search company"/>
            </li> 
            </ul>
            </form>
        </div> 
    
        <div class="answer hidden" id="answer6">
            <form class = "form-style-9" method="POST" action="index.php">
            <ul> 
            <li> 
                <input type="text" name="fragile_level" class="field-style field-full" placeholder="Write the fragile level"/>
            </li> 
            <li> 
                <input type="submit" name="operation" value="Search fragile products"/>
            </li> 
            </ul>
            </form>
        </div> 

        </li>
        </div>
        
        <!-- The part where the result comes -->
        <div class = "form-style-9">
        <p align="middle"> Result of the search:</p>
        <ul> 
			<li> 
				<?php
					session_start();
					$search = $_SESSION['search'];
					//$output_message = array("Product name", 
					if (isset($search))
					{
						foreach ($search as $s)
						{ 
							foreach ($s as $key => $value)
							{
								if (!is_numeric($key))
								{ 
                                    //echo "$key: ";
                                    if($key === "Product price")
                                    {
                                        echo "<p style='color:black;'>$key: $value €</p>";
                                    }else if($key === "Prouct warranty" and $value > 1)
                                    {
                                        echo "<p style='color:black;'>$key: $value years</p>";
                                    }else if($key === "Prouct warranty" and $value === 1)
                                    {
                                        echo "<p style='color:black;'>$key: $value year</p>"; 
                                    }else
                                    {
                                        echo "<p style='color:black;'>$key: $value</p>";
                                    }
								}
							}
							?> <hr> <?php
						}
						unset($_SESSION['search']);
					}
				?>
			</li>
        </ul>     
        </div> 

</div>


<script src="jquery.js"> </script> 
<script>
$(document).ready(function(){
	$('#faq-questions').on('change', function(){
        var theVal = $(this).val();
        $('.answer').addClass('hidden');
    	$('.answer#answer' + theVal).removeClass('hidden');
    });
});
</script>


</html>