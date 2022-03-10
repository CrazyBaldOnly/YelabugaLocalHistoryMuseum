
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Панель администратора</title>
  <link href= "ALstyles.css" rel= "stylesheet" type= "text/css"/>
 </head>
  <body>
  	<div class="admin">
		<?php
			session_start();
			if (isset($_SESSION['username'])) 
			{
				echo "Здравствуйте {$_SESSION['username']}!";
				echo '<a href="/logout.php">Выйти</a>';
			}
			else {header("Location: homepage.php");}
		?>
</div>
  	<form action="" method="POST">
		<center>
			<div class="logo">
				<img src="logo.jpeg">
			</div>
		
			<div class="a">
			<input type="submit" value ="Загрузить документ" formaction="/files1.php"></input>
			<input type="submit" value ="Настройка тегов" formaction="/tags1.php"></input>
			<input type="submit" value ="Настройка типов" formaction="/types1.php"></input>
			<input type="submit" value ="На главную" formaction="/homepage.php"></input>
			</div>
		</center>
	</form>
  </body>
</html>