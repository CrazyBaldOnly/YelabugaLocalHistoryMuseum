<!DOCTYPE html>
<html>
	<head>
		<title>test</title>
		<link href= "style.css" rel= "stylesheet" type= "text/css"/>
	</head>
	<body>
		<form class="clearfix" action="" method="POST">
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
					<option value="all" selected="selected">Все</option>
					<option value="newspapers">Газеты</option>
					<option value="letters">Письма</option>
					<option value="books">Книги</option>
					</select>
				</div>

				<div class="docsdate">
					<label>Дата появления документа:</label><br>
					<p>С</p> <input type="date" name="calendar1" value="<?php echo date('Y-m-d'); ?>">
					<p>По</p> <input type="date" name="calendar2" value="<?php echo date('Y-m-d'); ?>">
				</div>

				<div class="buttons">
					<input type="submit" name="submit" value="Отправить"></input>
					<input type="reset" name="reset" value="Очистить"></input>
					<p><a href="/adminlogin.php">Войти как администратор</a></p>
				</div>
				
			</center>
			
		</form>
	</body>
</html>
<?php
	$post = $_POST;
	echo '<pre>';
	print_r($post);
?>