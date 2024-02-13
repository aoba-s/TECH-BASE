<?php
    $str = "Hello world";
    $filename = "mission_1-26.txt";
    $fp = fopen($filename, "a");
    fwrite($fp, $str.PHP_EOL);
    fclose($fp);
    echo "書き込み成功！<br>";
    
    if(file_exists($filename)) {
        $datas = file($filename, FILE_IGNORE_NEW_LINES);
        foreach ($datas as $data) {
            echo $data . "<br>";
        }
    }
?>