<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<link href= "TagStyle.css" rel= "stylesheet" type= "text/css"/>
</head>
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
<center>
	<div class="logo">
		<img src="logo.jpeg">
	</div>	
	<form action="" method="POST">
		<input id="tags" name="tags" type="text" placeholder="Введите тег...">
		<div class="buttons">
			<input type="submit" name="select" value="Найти тег"></input>
			<input type="submit" name="add" value="Добавить тег"></input>
			<input type="submit" name="delete" value="Удалить тег"></input>
		</div>
	</form>

	<?php
		// В будущем раскидать все по функциям/классам
		include ('dbinfo.php');
		include ('DBRequests.php');
		$post = $_POST;
		if(isset($post['tags'])){
			$tags = $post['tags'];
			if(isset($post['select'])){ //Проверка была ли нажата кнопка

				//Вывести N последних добавленных тегов из таблицы.
				$query = "SELECT * FROM (
					SELECT * FROM `tags`
					WHERE `tag_name` LIKE '%$tags%' 	
					ORDER BY `tag_id` DESC LIMIT 50
				) A ORDER BY `tag_id`";
				tags_output($query);
				
			} elseif(isset($post['add']) and $tags != '' ){

				$query = "INSERT INTO `tags`(`tag_name`) VALUES ('$tags')";

				if ($mysqli->query($query) === TRUE) {
					echo "Тег добавлен в базу данных";
				} else {
					echo "Error: " . $mysqli->errno . "<br>" . $mysqli->error;
				}
			} elseif(isset($post['delete']) and $tags != ''){

				$query = "DELETE FROM `tags` WHERE `tag_name` = '$tags'";

				if ($mysqli->query($query) === TRUE) {
					echo "Тег удалён из базы данных";
				} else {
					echo "Error: " . $mysqli->errno . "<br>" . $mysqli->error;
				}
			} else {
				echo "При добвлении/удалении тега заполнение поля обязательно!";
			}
		}
		//Выводим последние 50 тегов, если никакого запроса не было
		else {$query = "SELECT * FROM 
			(SELECT * FROM `tags`
				ORDER BY `tag_id` DESC LIMIT 50
			) A ORDER BY `tag_id`";
			tags_output($query);
		}
		
	?>
	
</center>



