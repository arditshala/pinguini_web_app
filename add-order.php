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
</style>

<div style="margin-left:17%;padding:1px 16px;height:100%;">
    <h1 align="middle" > Add an Order </h1>
	
	<?php if (empty($_POST['number_of_forms'])) { ?>
	<form class = "form-style-9" method="POST" action="add-order.php">
        <ul>
			<li>
				<input type="text" name="number_of_forms" class="field-style field-split align-right" 
					placeholder="Insert number of items"/>
				<input type="submit" name="operation" value="Continue order"/>
			</li>
		</ul>
    </form>
	<?php } ?>
	
	<?php if (!empty($_REQUEST['operation']) && ($_REQUEST['operation'] == 'Continue order' && 
				!empty($_POST['number_of_forms']))){ ?>
    <form class = "form-style-9" method="POST" action="index.php">
        <ul>
            <li>
                <?php
                $customers = $controller->getAllCustomers();
                echo '<select name="customer_select" id="customer_select" class="field-style field-full">';
                echo '<option value="" disabled selected>Select customer for this order</option>';
                foreach ($customers as $customer)
                {
                    echo '<option value="'.$customer['customer_ID'].'">'.$customer['name'].'('.
                          $customer['phone_number'].')'.'</option>';
                }
                echo '</select>';
                ?>
            </li>
			
			<?php
			$number_of_forms = $_POST['number_of_forms'];
			$counter = 1;
			for ($i = 0; $i < $number_of_forms; $i++)
			{ 
				echo '<li>';
					$products = $controller->getAllProducts();
					echo "<select name=\"item_select($counter)\" id=\"item_select($counter)\" class=\"field-style field-full\">";
					echo "<option value=\"\" disabled selected>Product Name</option>";
					foreach ($products as $product)
					{
						echo '<option value="'.$product['product_ID'].'">'.$product['name'].'('.$product['customs_Code'].
                          ')'.'</option>';
					}
					echo '</select>';
				
					echo "<input type=\"number\" name=\"item_quantity($counter)\" class=\"field-style field-split align-right\"
						placeholder=\"Quantity\"/>";
				echo '</li>';
				$counter++;
			}
			?>
			
			<li>
				<div id="element1">
				<p> What type of shipping? </p>
				</div>
				<div id="element2">
				<input type="radio" name="shipping_type_radio" value="1" class="radio" id="one"/>
				<label for="one"> Fast shipping </label>
				<input type="radio" name="shipping_type_radio" value="0" class="radio" id="two" />
				<label for="two"> Normal shipping </label> 
				</div>
			</li>
			<li>
                <?php
                $shipping_companies = $controller->getAllShippingCompanies();
                echo '<select name="shipping_company_select" id="shipping_company_select" class="field-style field-full">';
                echo '<option value="" disabled selected>Choose Shipping company for this order</option>';
                foreach ($shipping_companies as $shipping_company)
                {
                    echo '<option value="'.$shipping_company['company_ID'].'">'.$shipping_company['name'].'('.$shipping_company['phone_number'].
                          ')'.'</option>';
                }
                echo '</select>';
                ?>
            </li>
			<li>
				<input type="text" name="receipt_ID" class="field-style field-split align-right" placeholder="receipt ID"/>
			</li>
			<li>
				<input type="number" name="discount" class="field-style field-split align-right"
                       placeholder="Discount"/>
			</li>
            <li>
                <input type="submit" name="operation" value="Add order"/>
            </li>
        </ul>
    </form>
	<?php } ?>
</div>

<?php
if(@$_GET['succ'] == 1)
{ ?>
    <!-- <p align="middle" style="background-color: #AEF359"> Thank you, the information was successfully stored! </p> -->
    <script type='text/javascript'>alert('Order successfully added!')</script>
<?php } ?>

<?php
if(@$_GET['err'] == 1)
{ ?>
    <!-- <p align="middle" style="background-color: #F778AI"> This supplier is already existent in the database! </p> -->
    <script type='text/javascript'>alert('There was a mistake, please add the order again!')</script>
<?php } ?>

</html>