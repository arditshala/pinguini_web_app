<html>
<head>
</head>
<body>
	<div>
		<h1>Register</h1>
		<?php
			if (@$_GET['err'] == 1)
			{ ?>
				<div>Username exists! Choose a new one!</div>	
		<?php } ?>
		<form method = "POST" action = "index.php">
			<p>Username:<br />
			<input type = "text" name="user" />
			</p>
			<p>Password:<br />
			<input type = "password" name = "password" />
			</p>
			<p>Email:<br />
			<input type = "text" name = "email" />
			</p>
			<input type = "submit" name = "operation" value = "register" />
		</form>
	</div>
</body>
</html>