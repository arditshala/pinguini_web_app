<?php

require_once('user_model.php');

class Repository
{

    private $connection;

    function __construct()
    {
        $this->connection = new PDO("mysql:host=localhost;dbname=pinguini", 'root', '');
    }

    function findUser($username, $password)
    {
        $stmt = $this->connection->prepare("SELECT username, user_password, user_ID
			FROM User_tb 
			WHERE  username = ? AND user_password = ?");
        $stmt->execute(array($username, $password));
        $user = $stmt->fetch();
		/*$myfile = fopen("log2.txt", "w") or die("Unable to open file!");
		fwrite($myfile, 'Username:'.$username);
		fwrite($myfile, 'Database Username:'.$user['username']);
		fwrite($myfile, 'Password:'.$password);
		fwrite($myfile, 'Database Password:'.$user['user_password']);
		fwrite($myfile, 'abcd');
		fclose($myfile);*/
        if ($username == $user['username'] && $password == $user['user_password']) {
			$user_ID = $user['user_ID'];
			/*$myfile = fopen("log3.txt", "w") or die("Unable to open file!");
			fwrite($myfile, 'User_ID:'.$user_ID);
			fclose($myfile);*/
        }
        return $user_ID;
    }

    function registerUser($name, $username, $password, $radio)
    {
        $successful = false;
        if ($this->findUser($username, $password) == TRUE) {
            return false;
        }
        $stmt = $this->connection->prepare('INSERT INTO User_tb(name, username, user_password, isAdmin)
			VALUES (:fname, :fusername, :fpassword, :fisAdmin)');

        $successful = $stmt->execute([
            'fname' => $name,
            'fusername' => $username,
            'fpassword' => $password,
            'fisAdmin' => $radio
        ]);
        return $successful;
    }

    function getTotalSales()
    {
		if(!isset($_SESSION)) 
		{ 
			session_start();
		}
		$user = $_SESSION['user'];
		$myfile = fopen("log3.txt", "w") or die("Unable to open file!");
		fwrite($myfile, 'User_ID:'.$user->get_user_ID());
		fclose($myfile);
        $stmt = $this->connection->prepare('SELECT SUM(nOrder.order_price) AS MonthTotalSale
			FROM nOrder 
			INNER JOIN makes ON nOrder.order_ID = makes.order_ID
			WHERE MONTH(nOrder.order_date) = MONTH(CURDATE())
			AND makes.user_ID = ?');
		$user_ID = $user->get_user_ID();
        $stmt->execute(array($user_ID));
        $result = $stmt->fetch();
        return $result;
    }

    function getBestSalers()
    {
        $stmt = $this->connection->prepare('SELECT name, username 
			FROM user_tb
			ORDER BY individual_revenue
			DESC
			LIMIT 3');
        $stmt->execute();
        return $stmt;
    }

    function addSupplier($supplier_name, $supplier_address,
                         $supplier_email, $supplier_phone, $supplier_country, $supplier_agg_number, $supplier_radio)
    {

        $successful = false;

        $stmt = $this->connection->prepare('INSERT INTO Supplier(name, address, email, phone, country, 
			agg_Number, isManufacturer)
			VALUES (:fname, :faddress, :femail, :fphone, :fcountry, :fagg_Number, :fisManufacturer)');

        $successful = $stmt->execute([
            'fname' => $supplier_name,
            'faddress' => $supplier_address,
            'femail' => $supplier_email,
            'fphone' => $supplier_phone,
            'fcountry' => $supplier_country,
            'fagg_Number' => $supplier_agg_number,
            'fisManufacturer' => $supplier_radio
        ]);
        return $successful;
    }

    function addCustomer($customer_name, $customer_surname, $customer_age, $customer_phone,
                         $customer_address, $customer_city, $customer_country)
    {
        $successful = false;

        $stmt = $this->connection->prepare('INSERT INTO Customer(name, phone_number, address, age, city, 
			country, surname)
			VALUES (:fname, :fphone_number, :faddress, :fage, :fcity, :fcountry, :fsurname)');

        $successful = $stmt->execute([
            'fname' => $customer_name,
            'fphone_number' => $customer_phone,
            'faddress' => $customer_address,
            'fage' => $customer_age,
            'fcity' => $customer_city,
            'fcountry' => $customer_country,
            'fsurname' => $customer_surname
        ]);
        return $successful;
    }

    function addProductDefault($product_name, $product_price,
                               $product_stock, $product_code, $product_warranty, $product_costums, $product_description, $company_select)
    {

        $successful = false;
        //$myfile = fopen("log.txt", "w") or die("Unable to open file!");

        $comp_ID = $this->getCompanyID($company_select);
        if (empty($comp_ID)) {
            header("Location:add-product.php");
        }
        //fwrite($myfile, 'ID'.$comp_ID);

        $stmt = $this->connection->prepare('INSERT INTO Product(name, inner_id, unit_Price, stock, 
			warranty_Duration, customs_Code, product_Description, comp_ID)
			VALUES (:fname, :finner_id, :funit_Price, :fstock, :fwarranty_Duration, 
			:fcustoms_Code, :fproduct_Description, :fcomp_ID)');

        $successful = $stmt->execute([
            'fname' => $product_name,
            'finner_id' => $product_code,
            'funit_Price' => $product_price,
            'fstock' => $product_stock,
            'fwarranty_Duration' => $product_warranty,
            'fcustoms_Code' => $product_costums,
            'fproduct_Description' => $product_description,
            'fcomp_ID' => $comp_ID
        ]);
        //fclose($myfile);
        return $successful;
    }

    function addProductCosm($product_name, $product_price, $product_stock, $product_code, $product_warranty,
                            $product_costums, $product_description, $company_select, $product_date, $product_radio)
    {
        //$myfile = fopen("log.txt", "w") or die("Unable to open file!");
        $successful1 = false;
        $successful2 = false;
        $comp_ID = $this->getCompanyID($company_select);
        if (empty($comp_ID)) {
            header("Location:add-product.php");
        }

        $stmt = $this->connection->prepare('INSERT INTO Product(name, inner_id, unit_Price, stock, 
			warranty_Duration, customs_Code, product_Description, comp_ID)
			VALUES (:fname, :finner_id, :funit_Price, :fstock, :fwarranty_Duration, 
			:fcustoms_Code, :fproduct_Description, :fcomp_ID)');


        $successful1 = $stmt->execute([
            'fname' => $product_name,
            'finner_id' => $product_code,
            'funit_Price' => $product_price,
            'fstock' => $product_stock,
            'fwarranty_Duration' => $product_warranty,
            'fcustoms_Code' => $product_costums,
            'fproduct_Description' => $product_description,
            'fcomp_ID' => $comp_ID
        ]);

        /*if ($successful1 == true)
        {
            fwrite($myfile, "successful");
        }
        else
        {
            fwrite($myfile, "fail");
        }*/

        //fclose($myfile);

        $stmt = $this->connection->prepare("SELECT product_ID 
			FROM Product 
			WHERE inner_id = ?");
        $stmt->execute(array($product_code));
        $product_ID_row = $stmt->fetch();
        $product_ID = $product_ID_row['product_ID'];

        if (!empty($product_ID)) {
            $stmt = $this->connection->prepare('INSERT INTO Acc_and_Cosm(product_ID, expiring_date, isPerscribed)
					VALUES (:fproduct_ID, :fexpiring_date, :fisPerscribed)');

            $successful2 = $stmt->execute([
                'fproduct_ID' => $product_ID,
                'fexpiring_date' => $product_date,
                'fisPerscribed' => $product_radio,
            ]);
        }

        return ($successful1 && $successful2);
    }

    function addProductElec($product_name, $product_price, $product_stock, $product_code, $product_warranty,
                            $product_costums, $product_description,
                            $company_select, $product_radio2, $product_temp, $product_fragile)
    {
        //$myfile = fopen("log.txt", "w") or die("Unable to open file!");
        $successful1 = false;
        $successful2 = false;
        $comp_ID = $this->getCompanyID($company_select);
        if (empty($comp_ID)) {
            header("Location:add-product.php");
        }

        $stmt = $this->connection->prepare('INSERT INTO Product(name, inner_id, unit_Price, stock, 
			warranty_Duration, customs_Code, product_Description, comp_ID)
			VALUES (:fname, :finner_id, :funit_Price, :fstock, :fwarranty_Duration, 
			:fcustoms_Code, :fproduct_Description, :fcomp_ID)');


        $successful1 = $stmt->execute([
            'fname' => $product_name,
            'finner_id' => $product_code,
            'funit_Price' => $product_price,
            'fstock' => $product_stock,
            'fwarranty_Duration' => $product_warranty,
            'fcustoms_Code' => $product_costums,
            'fproduct_Description' => $product_description,
            'fcomp_ID' => $comp_ID
        ]);

        /*if ($successful1 == true)
        {
            fwrite($myfile, "successful");
        }
        else
        {
            fwrite($myfile, "fail");
        }*/

        //fclose($myfile);

        $stmt = $this->connection->prepare("SELECT product_ID 
			FROM Product 
			WHERE inner_id = ?");
        $stmt->execute(array($product_code));
        $product_ID_row = $stmt->fetch();
        $product_ID = $product_ID_row['product_ID'];

        if (!empty($product_ID)) {
            $stmt = $this->connection->prepare('INSERT Electrical_devices(product_ID, 
					Temperature_Conditions, Fragile_Level, isTested)
					VALUES (:fproduct_ID, :fTemperature_Conditions, :fFragile_Level, :fisTested)');

            $successful2 = $stmt->execute([
                'fproduct_ID' => $product_ID,
                'fTemperature_Conditions' => $product_temp,
                'fFragile_Level' => $product_fragile,
                'fisTested' => $product_radio2
            ]);
        }

        return ($successful1 && $successful2);
    }

    function findUserId($username)
    {
        $stmt = $this->connection->prepare("SELECT user_ID 
              FROM User_tb
			  WHERE username = ?");
        $stmt->execute(array($username));
        $user_ID_row = $stmt->fetch();
        $user_ID = $user_ID_row['user_ID'];
        return $user_ID;
    }

    function addOrder($customer_select_ID, $item_select_ID, $item_quantity, $discount, 
			$receipt_ID, $shipping_type, $shipping_company_select_ID)
    {
        //$myfile = fopen("log.txt", "w") or die("Unable to open file!");
        session_start();
        if (!isset($_SESSION['user']))
        {
            header("Location:login.php");
        }

        $user = $_SESSION['user'];
        $username = $user->get_username();

        $user_ID = $this->findUserId($username);
        //fwrite($myfile, 'user_ID: '.$user_ID);
        //fwrite($myfile, 'customer_select_ID: '.$customer_select_ID);
        if (empty($user_ID)) {
            header("Location:login.php");
        }

        $this->connection->beginTransaction();

        $stmt = $this->connection->prepare('INSERT INTO makes(customer_ID, user_ID)
			VALUES (:fcustomer_ID, :fuser_ID)');

        $successful1 = $stmt->execute([
            'fcustomer_ID' => $customer_select_ID,
            'fuser_ID' => $user_ID
        ]);

        $order_ID = $this->connection->lastInsertId();

        $datetime = date_create()->format('Y-m-d');

        //fwrite($myfile, 'order_ID: '.$order_ID);
        //fwrite($myfile, 'order_date: '.$datetime);

        if (empty($order_ID)) {
            header("Location:add-order/err=1.php");
        }
            $stmt = $this->connection->prepare('INSERT INTO nOrder(order_date, order_ID, receipt_ID)
					VALUES (:forder_date, :forder_ID, :receipt_ID)');

            $successful2 = $stmt->execute([
                'forder_ID' => $order_ID,
                'forder_date' => $datetime,
				'receipt_ID' => $receipt_ID
            ]);

			
		//while loop where counter has to be incremented
		
		//price find for every item
		
		//item_quantity for every item
		//item_select_ID for every item
		
		//order_ID is the same for all items
		
		
		$size_array_item = sizeof($item_select_ID);
		$size_array_quantity = sizeof($item_quantity);
		
		$myfile = fopen("log.txt", "w") or die("Unable to open file!");
		fwrite($myfile, ''.sizeof($item_select_ID));
		fwrite($myfile, ''.sizeof($item_quantity));
		fclose($myfile);
		
		if ($size_array_item != $size_array_quantity)
		{
			return false;
		}
		
		for ($i = 1; $i <= $size_array_item; $i++)
		{
			$stmt = $this->connection->prepare("SELECT unit_Price 
				FROM Product 
				WHERE product_ID = ?");
			$stmt->execute(array($item_select_ID[$i]));
			$unit_Price_row = $stmt->fetch();
			$unit_Price = $unit_Price_row['unit_Price'];

			
			$stmt = $this->connection->prepare('INSERT INTO Order_Item(itemLineNumber, quantity, 
                      price, product_ID, order_ID)
			          VALUES (:fitemLineNumber, :fquantity, :fprice, :fproduct_ID, :forder_ID)');

			$successful3[$i] = $stmt->execute([
				'fitemLineNumber' => $i,
				'fquantity' => $item_quantity[$i],
				'fprice' => $unit_Price,
				'fproduct_ID' => $item_select_ID[$i],
				'forder_ID' => $order_ID,
			]);
		}
		//end of while loop
		
        $stmt = $this->connection->prepare("SELECT SUM(price*quantity ) AS 'Sum'
			FROM Order_Item 
			WHERE order_ID = ?");
        $stmt->execute(array($order_ID));
        $sum_row = $stmt->fetch();
        $price_sum = $sum_row['Sum'];
		$price_sum_discount = $price_sum - $discount;

        $stmt = $this->connection->prepare('UPDATE nOrder SET order_price = ? WHERE order_ID = ?');
        $successful4 = $stmt->execute(array($price_sum_discount, $order_ID));

		
		$stmt = $this->connection->prepare("SELECT country
			FROM Customer 
			WHERE customer_ID = ?");
        $stmt->execute(array($customer_select_ID));
        $shipping_country_row = $stmt->fetch();
        $shipping_country = $shipping_country_row['country'];
		
		if ($shipping_country == 'Kosovo')
		{
			$shipping_price = 2;
		}
		else
		{
			$shipping_price = 5;
		}
		
		$stmt = $this->connection->prepare('INSERT INTO Shipping(shipping_Type, shipping_Price, 
                      order_ID, company_ID)
			          VALUES (:fshipping_Type, :fshipping_Price, :forder_ID, :fcompany_ID)');

        $successful5 = $stmt->execute([
            'fshipping_Type' => $shipping_type,
            'fshipping_Price' => $shipping_price,
            'forder_ID' => $order_ID,
            'fcompany_ID' => $shipping_company_select_ID
        ]);
		
		$successful = true;
		for ($i = 1; $i <= $size_array_item; $i++)
		{
			$successful = $successful && $successful3[$i];
		}
		$successful = ($successful && (($successful1 && $successful2) && ($successful4 && $successful5)));
		
        if ($successful)
        {
            $this->connection->commit();
        }
        else
        {
            $this->connection->rollBack();
        }

        /*if ($successful1 == true)
        {
            fwrite($myfile, "successful1 is true");
        }
        if ($successful2 == true)
        {
            fwrite($myfile, "successful2 is true");
        }
        fclose($myfile);*/

        return $successful;
    }
	
	function deleteOrder($delete_tracking_id)
	{
		$stmt = $this->connection->prepare("SELECT *
			FROM Shipping
			WHERE tracking_ID = ?");
        $stmt->execute(array($delete_tracking_id));
		$res = $stmt->fetchAll();

		if (empty($res[0]))
		{
			return false;
			header("Location:delete-order.php?err=not_in_database");
		}
		
		$stmt = $this->connection->prepare("SELECT order_ID
			FROM Shipping
			WHERE tracking_ID = ?");
        $stmt->execute(array($delete_tracking_id));
		$delete_order_id_row = $stmt->fetch();
        $delete_order_id = $delete_order_id_row['order_ID'];
		
		
		$this->connection->beginTransaction();
		
		$stmt = $this->connection->prepare('DELETE FROM Shipping 
			          WHERE order_ID = ?');
		$successful1 = $stmt->execute(array($delete_order_id));
		
		$stmt = $this->connection->prepare('DELETE FROM Order_Item 
			          WHERE order_ID = ?');
		$successful2 = $stmt->execute(array($delete_order_id));
		
		$stmt = $this->connection->prepare('DELETE FROM nOrder
			          WHERE order_ID = ?');
		$successful3 = $stmt->execute(array($delete_order_id));
		
		$stmt = $this->connection->prepare('DELETE FROM makes
			          WHERE order_ID = ?');
		$successful4 = $stmt->execute(array($delete_order_id));
		
		$successful = (($successful1 && $successful2) && ($successful3 && $successful4));
		
		if ($successful)
        {
            $this->connection->commit();
        }
        else
        {
            $this->connection->rollBack();
        }
		
		return $successful;
	}

    function getAllSuppliers()
    {
        $stmt = $this->connection->prepare("SELECT name
			FROM Supplier");
        $stmt->execute();
        $suppliers = $stmt->fetchAll();
        return $suppliers;
    }

    function getAllCustomers()
    {
        $stmt = $this->connection->prepare("SELECT customer_ID, name, phone_number
			FROM Customer");
        $stmt->execute();
        $customers = $stmt->fetchAll();
        return $customers;
    }

    function getAllProducts()
    {
        $stmt = $this->connection->prepare("SELECT product_ID, name, customs_Code
			FROM Product");
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }
	
	function getAllShippingCompanies()
	{
		$stmt = $this->connection->prepare("SELECT company_ID, name, phone_number
			FROM Shipping_Comp");
        $stmt->execute();
        $shipping_companies = $stmt->fetchAll();
        return $shipping_companies;
	}

    function getCompanyID($supplier_name)
    {
        $stmt = $this->connection->prepare("SELECT comp_ID 
			FROM Supplier 
			WHERE name = ?");
        $stmt->execute(array($supplier_name));
        $comp_ID = $stmt->fetch();
        return $comp_ID['comp_ID'];
    }

    function searchProduct($search_product_input)
    {
        $stmt = $this->connection->prepare("SELECT Product.name AS 'Product name', 
				Product.inner_id AS 'Product inner id', Product.unit_Price AS 'Product price',
				Product.stock AS 'Product stock', Product.warranty_Duration AS 'Prouct warranty', 
				Product.product_Description AS 'Product description', Supplier.name AS 'Supplier name', 
				Supplier.country AS 'Supplier country'
				FROM Product
				INNER JOIN Supplier ON Product.comp_ID = Supplier.comp_ID
				WHERE Product.name = ?");
        $stmt->execute(array($search_product_input));
        $product_array = $stmt->fetchAll();
        return $product_array;
    }

    function searchEmployee($search_employee_input)
    {
        $stmt = $this->connection->prepare("SELECT name AS 'Employee name', indiviudal_revenue AS 'Revenue'
				FROM User_tb
				WHERE name = ?");
        $stmt->execute(array($search_employee_input));
        $employee_array = $stmt->fetchAll();
        return $employee_array;
    }

    function searchSupplier($search_supplier_input)
    {
        $stmt = $this->connection->prepare("SELECT name AS 'Name', address AS 'Address',
				email AS 'Email address', phone AS 'Phone number', country AS 'Country', 
				agg_Number AS 'Agreement number'
				FROM Supplier
				WHERE name = ?");
        $stmt->execute(array($search_supplier_input));
        $supplier_array = $stmt->fetchAll();
        return $supplier_array;
    }

    function searchCustomer($search_customer_input)
    {
        $stmt = $this->connection->prepare("SELECT name AS 'First name', surname AS 'Last name',
				phone_number AS 'Phone number', address AS 'Address', age AS 'Age', 
				city AS 'City', country AS 'Country'
				FROM Customer
				WHERE name = ?");
        $stmt->execute(array($search_customer_input));
        $customer_array = $stmt->fetchAll();
        return $customer_array;
    }

    function searchCompany($tracking_id_input)
    {
        $stmt = $this->connection->prepare("SELECT Shipping.shipping_Type AS 'Shipping type', 
				Shipping.country AS 'Shipping country', Shipping.shipping_Price AS 'Shipping price',
				Shipping.city AS 'Shipping city', Shipping_Comp.name AS 'Shipping company name', 
				Shipping_Comp.phone_number AS 'Shipping company phone number'
				FROM Shipping
				INNER JOIN Shipping_Comp ON Shipping.company_ID = Shipping_Comp.company_ID
				WHERE Shipping.tracking_ID = ?");
        $stmt->execute(array($tracking_id_input));
        $tracking_array = $stmt->fetchAll();
        return $tracking_array;
    }

    function searchFragile($fragile_level_input)
    {
        $stmt = $this->connection->prepare("SELECT Product.name AS 'Product name', 
				Product.inner_id AS 'Product code', Product.stock AS 'Stock',
				Electrical_devices.Temperature_Conditions AS 'Temperature conditions'
				FROM Electrical_devices
				INNER JOIN Product ON Electrical_devices.product_ID = Product.product_ID
				WHERE Electrical_devices.Fragile_Level = ?");
        $stmt->execute(array($fragile_level_input));
        $fragile_level_array = $stmt->fetchAll();
        return $fragile_level_array;
    }

    function checkIfExists($table, $column, $value)
    {
        $count = $this->connection->prepare("SELECT :col FROM :tab WHERE :col = :val");

        $count->execute(['col' => $column, 'tab' => $table, 'val' => $value]);

        $no = $count->rowCount();

        if ($no > 0) {
            return TRUE;
        }
        return FALSE;
    }
}
?>