<!DOCTYPE html>
<html>
	<head>
		<title>test</title>
		<link href= "HPstyle.css" rel= "stylesheet" type= "text/css"/>
	</head>
	<body>
		<form class="clearfix" action="" method="POST">
			<div class= "admin">
				<?php
					session_start();
					if (isset($_SESSION['username'])) 
					{
						echo "Здравствуйте {$_SESSION['username']}!";
						echo '<a href="/logout.php">Выйти</a>';
					}
					else {echo '<a href="/adminlogin.php">Администратор</a>';}
				?>
			</div>
			<center>
				<div class="logo">
					<img src="logo.jpeg">
				</div>	
				<div class="d1">
					<input id="search1" name="search" type="text" placeholder="Введите название документа...">
					<br>
					<input id="searchtags" name="tagsearch" type="text" placeholder="Введите теги...">
				</div>

				<div class="d3">
					<label " for="doctypes">Тип документа</label>
                    <select id="doctypes" name="doctype" class="form-select">
                    <?php include ('DBRequests.php');
                        types();
                    ?>
                    </select>
				</div>

				<div class="docsdate">
					<label>Дата появления документа:</label><br>
					<p>С</p> 
					<input type="date" name="calendar1" value="">
					<p>По</p> 
					<input type="date" name="calendar2" value="">
				</div>

				<div class="buttons">
					<input type="submit" name="submit" value="Отправить"></input>
					<input type="reset" name="reset" value="Очистить"></input>
				</div>
			</center>
			<?php 
				$query = 'SELECT * FROM `main`';
				homepage($query);
			?>
		</form>
	</body>
</html>
