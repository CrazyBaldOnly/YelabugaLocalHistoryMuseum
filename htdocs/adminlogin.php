<link href= "ALstyles.css" rel= "stylesheet" type= "text/css"/>
<meta charset="utf-8">
<form action="" method="POST">
	<center>
		<div class="logo">
			<img src="logo.jpeg">
		</div>	
		<div class="container">
			<input id="login" type="text" placeholder="Введите имя пользователя" name="username" required><br>
			<input id="pasw" type="password" placeholder="Введите пароль" name="password" required><br>
			<input type="submit" name="Login" value="Войти"></input>
		</div>
	</center>
</form>
<?php
    
    include ("dbinfo.php");
    session_start();

    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' LIMIT 1 ";
        $result = $mysqli->query($query);
        while ($value = $result->fetch_array()) {
            $_SESSION['username'] = $value['username'];
            $_SESSION['password'] = $value['password'];
            setcookie("login",$_SESSION['username'], time());
            setcookie("password",$_SESSION['password'], time() + (60*60*24*30));
        }
    }
	if(isset($_SESSION['username']))
	{
		header("Location: adminpanel.php");
	}
?>