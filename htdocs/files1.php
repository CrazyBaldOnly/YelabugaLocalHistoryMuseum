
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Добавление файла в базу данных</title>
  <link href= "HPstyle.css" rel= "stylesheet" type= "text/css"/>
 </head>
    <body>
        <form class="clearfix" enctype="multipart/form-data" action="" method="POST">
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
                <div class="d1">
                    <input id="search1" name="search" type="text" required placeholder="Введите название документа...">
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
                    <p>Введите дату документа</p> 
                    <input type="date" name="calendar" value="">
                </div>

                <div class = "buttons">
                    <p><input type="file" name='upload_file'></p>
                    <input type="submit" name="submit" value="Отправить"></input>
                    <input type="reset" name="reset" value="Очистить"></input>
                </div>
            </center>
        </form> 
    </body>
</html>
<?php
    $filename = $_POST['search'];
    $date = $_POST['calendar'];
    $file = "upload/".$_FILES['upload_file']['name'];
    move_uploaded_file($_FILES['upload_file']['tmp_name'], $file);
    if(isset($_POST['submit'])){
        $query = "INSERT INTO `main` (`name`,`date`,`path`) VALUES ('$filename','$date','$file')";
        $result = $mysqli->query($query);    
    }

?>