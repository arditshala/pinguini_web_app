<?php 
    session_start();
    if (isset($_SESSION['user']))
    {
        header("Location:dashboard.php");
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
</style>
    <div style="margin-left:17%;padding:1px 16px;height:100%;overflow: hidden;">
        
        <div class="login-page">
        <div align="center">
            <img src="gif2.gif"/>
        </div>
            <div class="form">
              <form class="register-form">
                <input type="text" placeholder="name" name="user2"/>
                <input type="password" placeholder="password" name="password2"/>
                 <input type="text" placeholder="email address"/>
                 <button>create</button>
              </form>
             <?php 
                if(@$_GET['err'] == 1)
                { ?>
                    <div> Username and Password do not match! Try again! </div>
              <?php } ?>
             <form class="login-form" method="POST" action="index.php">
                 <input type="text" placeholder="username" name="user"/>
                 <input type="password" placeholder="password" name="password"/>
                <!--<button>login</button> -->
                <input type="submit" name="operation" value="login" />
                 <p class="message">You have a problem? <a href="mailto:admin@pinguini.store">Contact Administrator</a></p>
             </form>
            </div>
        </div>
        
    </div>

</html>

