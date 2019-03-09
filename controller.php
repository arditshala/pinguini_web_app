<?php

require_once('user_model.php');

class Controller{
	
	
	private $repository;
	
	function __construct()
	{
		require_once('repository.php');
		$this->repository = new Repository();
	}
	
	function createUser($username, $password, $email)
	{
		//register new user in Database
	}
	
	function loginUser($username, $password)
	{
		if (!empty($this->repository->findUser($username, $password)))
		{
			$user_ID = $this->repository->findUser($username, $password);
			$myfile = fopen("log3.txt", "w") or die("Unable to open file!");
			fwrite($myfile, 'Im in the if');
			fwrite($myfile, 'User_ID:'.$user_ID);
			fclose($myfile);
			if(!isset($_SESSION)) 
			{ 
				session_start();
			}
			$user = new UserModel($username, $password, $user_ID);
			$_SESSION['user'] = $user;
			return true;
		}
		$myfile = fopen("log4.txt", "w") or die("Unable to open file!");
		fwrite($myfile, 'Im returning false');
		fclose($myfile);
		return false;
	}
	
	function registerUser($name, $username, $password, $radio)
	{
		if ($this->repository->registerUser($name, $username, $password, $radio) == TRUE)
		{
			return true;
		}
		return false;
	}
	
	function getTotalSales()
	{
		return $this->repository->getTotalSales();
	}
	
	function getBestSalers()
	{
		return $this->repository->getBestSalers();
	}
	
	function addSupplier($supplier_name, $supplier_address, 
				$supplier_email, $supplier_phone, $supplier_country, $supplier_agg_number, $supplier_radio)
	{
		return $this->repository->addSupplier($supplier_name, $supplier_address, 
			$supplier_email, $supplier_phone, $supplier_country, $supplier_agg_number, $supplier_radio);	
	}
	
	function addProduct($product_name, $product_price, 
			$product_stock, $product_code, $product_warranty, $product_costums, $product_description, 
			$company_select, $product_date, $product_radio, $product_radio2, $product_temp, $product_fragile)
	{
		if (!empty($product_date) || isset($product_radio))
		{
			return $this->repository->addProductCosm($product_name, $product_price, 
					$product_stock, $product_code, $product_warranty, $product_costums, $product_description, 
					$company_select, $product_date, $product_radio);
		}	
		else if (isset($product_radio2) || !empty($product_temp) || !empty($product_fragile))
		{
			return $this->repository->addProductElec($product_name, $product_price, 
					$product_stock, $product_code, $product_warranty, $product_costums, $product_description, 
					$company_select, $product_radio2, $product_temp, $product_fragile);
		}
		else{
			return $this->repository->addProductDefault($product_name, $product_price, $product_stock, 
			$product_code, $product_warranty, $product_costums, $product_description, $company_select);
		}
	}
	
	function addCustomer($customer_name, $customer_surname,$customer_age, $customer_phone, 
						$customer_address, $customer_city, $customer_country)
	{
		return $this->repository->addCustomer($customer_name, $customer_surname, 
			$customer_age, $customer_phone, $customer_address, $customer_city, $customer_country);	
	}

    function addOrder($customer_select_ID, $item_select_ID, $item_quantity, $discount, 
			$receipt_ID, $shipping_type, $shipping_company_select_ID)
    {
        return $this->repository->addOrder($customer_select_ID, $item_select_ID, $item_quantity, $discount, 
			$receipt_ID, $shipping_type, $shipping_company_select_ID);
    }
	
	function deleteOrder($delete_tracking_id)
	{
		return $this->repository->deleteOrder($delete_tracking_id);
	}
	
	function getAllSuppliers()
	{
		return $this->repository->getAllSuppliers();
	}

    function getAllCustomers()
    {
        return $this->repository->getAllCustomers();
    }

    function getAllProducts()
    {
        return $this->repository->getAllProducts();
    }
	
	function getAllShippingCompanies()
	{
		return $this->repository->getAllShippingCompanies();
	}
	
	function searchProduct($search_product_input)
	{
		return $this->repository->searchProduct($search_product_input);	
	}
	
	function searchEmployee($search_employee_input)
	{
		return $this->repository->searchEmployee($search_employee_input);	
	}
	
	function searchSupplier($search_supplier_input)
	{
		return $this->repository->searchSupplier($search_supplier_input);	
	}
	
	function searchCustomer($search_customer_input)
	{
		return $this->repository->searchCustomer($search_customer_input);	
	}
	
	function searchCompany($tracking_id_input)
	{
		return $this->repository->searchCompany($tracking_id_input);	
	}
	
	function searchFragile($fragile_level_input)
	{
		return $this->repository->searchFragile($fragile_level_input);
	}

    function checkIfExists($table, $column, $value)
    {
        return $this->repository->checkIfExists($table, $column, $value);
    }

	function logout()
	{
		session_start();
		session_destroy();
	}
}
?>