<?php
	// include ('dbinfo.php');
	// $result = $mysqli->query($query);

    // Вывод через while
    // while ($value = $result->fetch_assoc()) {
    //     echo "<pre>";
    //     print_r($value);	
    //     echo "</pre>";
    // }

    // Вывод через foreach
    // foreach ($result as $value){
    //     echo "<pre>";
    //     print_r($value);	
    //     // echo $value['tag_name'];
    //     echo "</pre>";
    // }

    include ('dbinfo.php');
    function tags_output($query){
        global $mysqli;
        $result = $mysqli->query($query);
        $rowsCount = $result->num_rows; // количество полученных строк
        echo "<p>Получено строк: $rowsCount</p>";
        // Вывод через while
        echo '<table class="table"><tr><th>Id</th><th>Тег</th>';
        while ($value = $result->fetch_array()) {
            echo "<tr>";
                echo "<td>" . $value["tag_id"] . "</td>";
                echo "<td>" . $value["tag_name"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    function types_output($query){
        global $mysqli;
        $result = $mysqli->query($query);
        $rowsCount = $result->num_rows; // количество полученных строк
        echo "<p>Получено строк: $rowsCount</p>";
        // Вывод через while
        echo '<table class="table"><tr><th>Id</th><th>Тип</th>';
        while ($value = $result->fetch_array()) {
            echo "<tr>";
                echo "<td>" . $value["type_id"] . "</td>";
                echo "<td>" . $value["type_name"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    function types(){
        global $mysqli;
        $query = 'SELECT * FROM `types`';
        $result = $mysqli->query($query);
        while ($value = $result->fetch_array()){
            $types = $value['type_name'];
            echo '<option value=' .$types. '>' .$types.'</option>';
        }
    }

    function homepage($query){
        global $mysqli;
        $result = $mysqli->query($query);
        // Вывод через while
        echo '<table class="table"><tr><th>Id</th><th>Название</th><th>Дата</th><th>Скачать</th>';
        while ($value = $result->fetch_array()) {
            echo "<tr>";
                echo "<td>" . $value["id"] . "</td>";
                echo "<td>" . $value["name"] . "</td>";
                echo "<td>" . $value["date"] . "</td>";
                echo '<td><input type="submit" name="' . $value['path'] . '" value="Загрузить!"></td>';
            echo "</tr>";
        }
        echo "</table>";

        if(end($_POST) == 'Загрузить!'){
            //блок замены окончания файла (меняет _doc на .doc)
            $filename = array_key_last($_POST);
            $file_end = strrchr($filename,'_');
            $file_end2 = str_replace('_', '.',$file_end);
            $filename = str_replace($file_end,$file_end2,$filename);

            //Блок скачивания файла
            if (file_exists($filename)) {
                // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
                // если этого не сделать файл будет читаться в память полностью!
                if (ob_get_level()) {
                  ob_end_clean();
                }
                // заставляем браузер показать окно сохранения файла
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($filename));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filename));
                // читаем файл и отправляем его пользователю
                readfile($filename);
                exit;
            }
        }

    }

?>