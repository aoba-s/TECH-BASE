<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-01</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前">
        <input type="text" name="comment" placeholder="コメント">
        <input type="submit" name="submit">
    </form>
    <?php
        if(!empty($_POST["name"]) && !empty($_POST["comment"])) {
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            $filename = "mission_3-1.txt";
            if (file_exists($filename)) {
                $fp = fopen($filename, "r");
                for($submitNumber = 1; fgets($fp); $submitNumber++);
                fclose($fp);
            } else {
                $submitNumber = 1;
            }
            $fp = fopen($filename, "a");
            $savetext = $submitNumber . "<>" . $name . "<>" . $comment . "<>" . date("Y/m/d H:i:s");
            fwrite($fp, $savetext.PHP_EOL);
            fclose($fp);
            echo $comment . " を受け付けました。<br>";
        }
    ?>
</body>
</html>