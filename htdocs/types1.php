<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<link href= "TypesStyle.css" rel= "stylesheet" type= "text/css"/>
</head>
<div class= "admin">
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
<center>
	<div class="logo">
		<img src="logo.jpeg">
	</div>
	<form action="" method="POST">
		<input id="types" name="types" type="text" placeholder="Введите тип документа...">
		<div class="buttons">
			<input type="submit" name="select" value="Найти тип"></input>
			<input type="submit" name="add" value="Добавить тип"></input>
			<input type="submit" name="delete" value="Удалить тип"></input>
		</div>
	</form>

	<?php
		include ('dbinfo.php');
		include ('DBRequests.php');
		$post = $_POST;
		if(isset($post['types'])){
			$types = $post['types'];
			if(isset($post['select'])){ //Проверка была ли нажата кнопка

				//Вывести N последних добавленных тегов из таблицы.
				$query = "SELECT * FROM (
					SELECT * FROM `types`
					WHERE `type_name` LIKE '%$types%' 	
					ORDER BY `type_id` DESC
				) A ORDER BY `type_id`";
				types_output($query);

			} elseif(isset($post['add']) and $types != '' ){

				$query = "INSERT INTO `types`(`type_name`) VALUES ('$types')";

				if ($mysqli->query($query) === TRUE) {
					echo "Тиг добавлен в базу данных";
				} else {
					echo "Error: " . $mysqli->errno . "<br>" . $mysqli->error;
				}
			} elseif(isset($post['delete']) and $types != ''){

				$query = "DELETE FROM `types` WHERE `type_name` = '$types'";
				
				if ($mysqli->query($query) === TRUE) {
					echo "Тиг удалён из базы данных";
				} else {
					echo "Error: " . $mysqli->errno . "<br>" . $mysqli->error;
				}
			} else {
				echo "При добвлении/удалении типа заполнение поля обязательно!";
			}
		}
		//Выводим последние 50 тегов, если никакого запроса не было
		else {$query = "SELECT * FROM `types`";
			types_output($query);
		}
	?>
</center>