<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-27</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="num" placeholder="数字を入力してね">
        <input type="submit" name="submit">
    </form>
    <?php
        if(!empty($_POST["num"])) {
            $num = $_POST["num"];
            $filename = "mission_1-27.txt";
            $fp = fopen($filename, "a");
            fwrite($fp, $num.PHP_EOL);
            fclose($fp);
            echo "書き込み成功！<br>";
        
            if(file_exists($filename)) {
                $datas = file($filename, FILE_IGNORE_NEW_LINES);
                foreach ($datas as $data) {
                    if($data%15==0) {
                        echo "FizzBuzz ";
                    } else if ($data%3==0) {
                        echo "Fizz ";
                    } else if ($data%5==0) {
                        echo "Buzz ";
                    } else {
                        echo $data . " ";
                    }
                }
            }
        }
    ?>
</body>
</html>