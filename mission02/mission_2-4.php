<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-04</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="comment" placeholder="コメント">
        <input type="submit" name="submit">
    </form>
    <?php
        $filename = "mission_2-4.txt";
        if(!empty($_POST["comment"])) {
            $comment = $_POST["comment"];
            $fp = fopen($filename, "a");
            fwrite($fp, $comment.PHP_EOL);
            fclose($fp);
            if ($comment=="完成！") {
                echo "おめでとう！";
            } else {
                echo $comment . " を受け付けました。";
            }
            echo "<br>";
        }
        if(file_exists($filename)) {
            $datas = file($filename, FILE_IGNORE_NEW_LINES);
            foreach($datas as $data) {
                echo $data . "<br>";
            }
        }
    ?>
</body>
</html>