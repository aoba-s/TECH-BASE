<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-03</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="comment" placeholder="コメント">
        <input type="submit" name="submit">
    </form>
    <?php
        if(!empty($_POST["comment"])) {
            $comment = $_POST["comment"];
            $filename = "mission_2-3.txt";
            $fp = fopen($filename, "a");
            fwrite($fp, $comment.PHP_EOL);
            fclose($fp);
            if ($comment=="完成！") {
                echo "おめでとう！";
            } else {
                echo $comment . " を受け付けました。";
            }
        }
    ?>
</body>
</html>