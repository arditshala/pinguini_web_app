<html>
    <link rel="stylesheet" href="styles.css">
    <script>
        function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('txt').innerHTML =
        h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
        }
    </script>

    <div class="sidenav">
        <img id="logo" align="bottom" src="images/logo-2.png" alt="logo"/>
        <p></p>

        <body color="whote" onload="startTime()">
                    <div color="white" align="center" id="txt"></div>            
        </body>

        <p></p>
        <p></p>
        <a class="a" href="dashboard_admin.php"><img id="dash_logo" src="images/nav-icons/dash_logo.png"/> Dashboard</a>
        <a class="a" href="add-order.php"><img id="add_logo" src="images/nav-icons/add_logo.png"/> Add new order</a>
        <a class="a" href="delete-order.php"><img id="bin_logo" src="images/nav-icons/bin_logo.png"/> Delete an order</a>
        <a class="a" href="add-product.php"><img id="box_logo" src="images/nav-icons/box_logo.png"/> Add a product</a>
        <a class="a" href="add-customer.php"><img id="customer_logo" src="images/nav-icons/customer_logo.png"/> Add a customer</a>
        <a class="a" href="add-supplier.php"><img id="supplier_logo" src="images/nav-icons/supplier_logo.png"/> Add a supplier</a>
        <a class="a" href="search-engine.php"><img id="list_logo" src="images/nav-icons/list_logo.png"/> Search Engine</a>
        <a class="a" href="user-data.php"><img id="user_logo" src="images/nav-icons/user_logo.png"/> User Data</a>
        <a class="a" href="imprint.php"><img id="terms_logo" src="images/nav-icons/terms_logo.png"/> Imprint</a>
        <a class="a" href="about.php"><img id="about_logo" src="images/nav-icons/info_logo.png"/> About</a>
    </div>
    
</html>
