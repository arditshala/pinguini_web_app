<?php

require_once('controller.php');
require_once('user_model.php');


if (!empty($_REQUEST['operation'])) {
	$operation = $_REQUEST['operation'];
}

$controller = new Controller();

switch($operation)
{
	case 'login':
		if (!empty($_POST['user'])) {
			$username = $_POST['user'];
		}
		if (!empty($_POST['password'])) {
			$password = $_POST['password'];
		}
		
		if ($controller->loginUser($username, $password) == TRUE)
		{
			header("Location:dashboard_admin.php");
		}
		else
		{
			$myfile = fopen("log.txt", "w") or die("Unable to open file!");
			fwrite($myfile, 'Username:'.$username);
			fwrite($myfile, 'Password:'.$password);
			fclose($myfile);
			header("Location:login.php?err=1");
		}
	break;
	
	case 'new registration':
		header("Location:register.php");
		break;
	
	case 'logout':
		$controller->logout();
		header("Location:login.php");
	break;
	
	case 'register':
		if (isset($_POST['name'])) {
			$name = $_POST['name'];
		}
		if (isset($_POST['user'])) {
			$username = $_POST['user'];
		}
		if (isset($_POST['password'])) {
			$password = $_POST['password'];
		}
		if (isset($_POST['radio'])) {
			$radio = $_POST['radio'];
		}
		
		if ($controller->registerUser($name, $username, $password, $radio) == TRUE)
		{
			header("Location:login.php");
		}
		else
		{
			header("Location:register.php?err=1");
		}
		break;
		
	case 'Add supplier':
		if (isset($_POST['supplier_name'])) {
			$supplier_name = $_POST['supplier_name'];
		}
		if (isset($_POST['supplier_address'])) {
			$supplier_address = $_POST['supplier_address'];
		}
		if (isset($_POST['supplier_email'])) {
			$supplier_email = $_POST['supplier_email'];
		}
		if (isset($_POST['supplier_phone'])) {
			$supplier_phone = $_POST['supplier_phone'];
		}
		if (isset($_POST['supplier_country'])) {
			$supplier_country = $_POST['supplier_country'];
		}
		if (isset($_POST['supplier_agg_number'])) {
			$supplier_agg_number = $_POST['supplier_agg_number'];
		}
		if (isset($_POST['supplier_radio'])) {
			$supplier_radio = $_POST['supplier_radio'];
		}
		
		if ($controller->addSupplier($supplier_name, $supplier_address, 
			$supplier_email, $supplier_phone, $supplier_country, $supplier_agg_number, $supplier_radio) == TRUE)
		{
			header("Location:add-supplier.php?succ=1");
		}
		else
		{
			header("Location:add-supplier.php?err=1");
		}
		break;
		
	case 'Add product':
		if (!empty($_POST['product_name'])) {
			$product_name = $_POST['product_name'];
		}
		if (!empty($_POST['product_price'])) {
			$product_price = $_POST['product_price'];
		}
		if (!empty($_POST['product_stock'])) {
			$product_stock = $_POST['product_stock'];
		}
		if (!empty($_POST['product_code'])) {
			$product_code = $_POST['product_code'];
		}
		if (!empty($_POST['product_warranty'])) {
			$product_warranty = $_POST['product_warranty'];
		}
		if (!empty($_POST['product_costums'])) {
			$product_costums = $_POST['product_costums'];
		}
		if (!empty($_POST['product_description'])) {
			$product_description = $_POST['product_description'];
		}
		if (!empty($_POST['company_select'])) {
			$company_select = $_POST['company_select'];
		}
		if (!empty($_POST['product_date'])) {
			$product_date = $_POST['product_date'];
		}
		if (!empty($_POST['product_radio'])) {
			$product_radio = $_POST['product_radio'];
		}
		if (!empty($_POST['product_radio2'])) {
			$product_radio2 = $_POST['product_radio2'];
		}
		if (!empty($_POST['product_temp'])) {
			$product_temp = $_POST['product_temp'];
		}
		if (!empty($_POST['product_fragile'])) {
			$product_fragile = $_POST['product_fragile'];
		}

        //$myfile = fopen("log.txt", "w") or die("Unable to open file!");
		//if (isset($product_price))
		//{
          //  fwrite($myfile, 'price: ' . $product_price);
       // }
        //fclose($myfile);

		if ($controller->addProduct($product_name, $product_price, 
			$product_stock, $product_code, $product_warranty, $product_costums, $product_description, 
			$company_select, $product_date, $product_radio, $product_radio2, $product_temp, $product_fragile) == TRUE){
			header("Location:add-product.php?succ=1");
		}
		else
		{
			header("Location:add-product.php?err=1");
		}
		break;
		
	case 'Add customer':
		if (!empty($_POST['customer_name'])) {
			$customer_name = $_POST['customer_name'];
		}
		if (!empty($_POST['customer_surname'])) {
			$customer_surname = $_POST['customer_surname'];
		}
		if (!empty($_POST['customer_age'])) {
			$customer_age = $_POST['customer_age'];
		}
		if (!empty($_POST['customer_phone'])) {
			$customer_phone = $_POST['customer_phone'];
		}
		if (!empty($_POST['customer_address'])) {
			$customer_address = $_POST['customer_address'];
		}
		if (!empty($_POST['customer_city'])) {
			$customer_city = $_POST['customer_city'];
		}
		if (!empty($_POST['customer_country'])) {
			$customer_country = $_POST['customer_country'];
		}
		
		if ($controller->addCustomer($customer_name, $customer_surname,$customer_age, 
			$customer_phone, $customer_address, $customer_city, $customer_country) == TRUE){
			header("Location:add-customer.php?succ=1");
		}
		else
		{
			header("Location:add-customer.php?err=1");
		}
		break;
		
	case 'Search product':
		if (!empty($_POST['product_name'])) {
			$search_product_input = $_POST['product_name'];
		}
		$search_product_result = $controller->searchProduct($search_product_input);
		
		if (!empty($search_product_result[0]))
		{
			$search_product = $controller->searchProduct($search_product_input);
			session_start();
			$_SESSION['search'] = $search_product;
			header("Location:search-engine.php");
		}
		else 
		{
			header("Location:search-engine.php?err=no_such_product");
		}
		break;
	
	case 'Search Employee':
		if (!empty($_POST['employee_name'])) {
			$search_employee_input = $_POST['employee_name'];
		}
		$search_employee_result = $controller->searchEmployee($search_employee_input);
	
		if (!empty($search_employee_result[0]))
		{
			$search_employee = $controller->searchEmployee($search_employee_input);
			session_start();
			$_SESSION['search'] = $search_employee;
			header("Location:search-engine.php");
		}
		else 
		{
			header("Location:search-engine.php?err=no_such_employee");
		}
		break;
		
	case 'Search supplier':
		if (!empty($_POST['supplier_name'])) {
			$search_supplier_input = $_POST['supplier_name'];
		}
		$search_supplier_result = $controller->searchSupplier($search_supplier_input);
	
		if (!empty($search_supplier_result[0]))
		{
			$search_supplier = $controller->searchSupplier($search_supplier_input);
			session_start();
			$_SESSION['search'] = $search_supplier;
			header("Location:search-engine.php");
		}
		else 
		{
			header("Location:search-engine.php?err=no_such_supplier");
		}
		break;
		
	case 'Search customer':
		if (!empty($_POST['customer_name'])) {
			$search_customer_input = $_POST['customer_name'];
		}
		$search_customer_result = $controller->searchCustomer($search_customer_input);
	
		if (!empty($search_customer_result[0]))
		{
			$search_customer = $controller->searchCustomer($search_customer_input);
			session_start();
			$_SESSION['search'] = $search_customer;
			header("Location:search-engine.php");
		}
		else 
		{
			header("Location:search-engine.php?err=no_such_customer");
		}
		break;
	
	case 'Search company':
		if (!empty($_POST['tracking_id'])) {
			$tracking_id_input = $_POST['tracking_id'];
		}
		$tracking_id_result = $controller->searchCompany($tracking_id_input);
	
		if (!empty($tracking_id_result[0]))
		{
			$search_company = $controller->searchCompany($tracking_id_input);
			session_start();
			$_SESSION['search'] = $search_company;
			header("Location:search-engine.php");
		}
		else 
		{
			header("Location:search-engine.php?err=no_such_trackingID");
		}
		break;
		
	case 'Search fragile products':
		if (!empty($_POST['fragile_level'])) {
			$fragile_level_input = $_POST['fragile_level'];
		}
		$fragile_level_result = $controller->searchFragile($fragile_level_input);
	
		if (!empty($fragile_level_result[0]))
		{
			$fragile_level = $controller->searchFragile($fragile_level_input);
            if(!isset($_SESSION))
            {
                session_start();
            }
			$_SESSION['search'] = $fragile_level;
			header("Location:search-engine.php");
		}
		else 
		{
			header("Location:search-engine.php?err=no_such_fragile_level");
		}
		break;

    case 'Add order':
        if (!empty($_POST['customer_select']) /*&& $controller->checkIfExists('Customer', 'customer_ID', $_POST['customer_select'])*/) {
                $customer_select_ID = $_POST['customer_select'];
        }
		
		$counter = 1;
		while (!empty($_POST["item_select($counter)"]))
		{
			if (!empty($_POST["item_select($counter)"]) /*&& $controller->checkIfExists('Product', 'product_ID', $_POST['item_select'])*/) {
				$item_select_ID[$counter] = $_POST["item_select($counter)"];
			}
			$counter++;
			if ($counter > 500)
			{
				//attempt for POST brute force attack
				header("Location:add-order.php");
			}
		}
		$counter = 1;
		while (!empty($_POST["item_quantity($counter)"]))
		{
			if (!empty($_POST["item_quantity($counter)"]) && $_POST["item_quantity($counter)"] >= 0) {
				$item_quantity[$counter] = $_POST["item_quantity($counter)"];
			}
			$counter++;
			if ($counter > 500)
			{
				//attempt for POST brute force attack
				header("Location:add-order.php");
			}
		}
		
        if (!empty($_POST['discount']) && $_POST['discount'] >= 0) {
            $discount = $_POST['discount'];
        }
		if (!empty($_POST['receipt_ID'])) {
            $receipt_ID = $_POST['receipt_ID'];
        }
		if (isset($_POST['shipping_type_radio'])) {
			if ($_POST['shipping_type_radio'] == 1)
			{
				$shipping_type = 'fast';
			}
			else
			{
				$shipping_type = 'normal';
			}
		}
		if (!empty($_POST['shipping_company_select']) /*&& $controller->checkIfExists('Product', 'product_ID', $_POST['item_select'])*/) {
            $shipping_company_select_ID = $_POST['shipping_company_select'];
        }

        if ($controller->addOrder($customer_select_ID, $item_select_ID, $item_quantity, $discount, 
			$receipt_ID, $shipping_type, $shipping_company_select_ID) == TRUE){
            header("Location:add-order.php?succ=1");
        }
        else
        {
            header("Location:add-order.php?err=1");
        }
    break;

	case 'Delete order':
		if (!empty($_POST['delete_tracking_id']) /*&& $controller->checkIfExists('Customer', 'customer_ID', $_POST['customer_select'])*/) {
               $delete_tracking_id = $_POST['delete_tracking_id'];
        }
		
		if ($controller->deleteOrder($delete_tracking_id) == TRUE){
            header("Location:delete-order.php?succ=1");
        }
        else
        {
            header("Location:delete-order.php?err=1");
        }
	break;
	
    default:
        header("Location:login.php");
        break;
}	
?>