<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-03</title>
</head>
<body>
    <form action="" method="post">
        <p>投稿</p>
        <input type="text" name="name" placeholder="名前">
        <input type="text" name="comment" placeholder="コメント">
        <input type="submit" name="commentSubmit" value="投稿">
    </form>
    <form action="" method="post">
        <p>削除</p>
        <input type="text" name="number" placeholder="投稿番号">
        <input type="submit" name="deleteSubmit" value="削除">
    </form>
    <?php
        $filename = "mission_3-3.txt";
        if (!empty($_POST["commentSubmit"]) && !empty($_POST["name"]) && !empty($_POST["comment"])) {
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            if (file_exists($filename)) {
                $datas = file($filename, FILE_IGNORE_NEW_LINES);
                $lastData = explode("<>", end($datas));
                $submitNumber = $lastData[0] + 1;
            } else {
                $submitNumber = 1;
            }
            $fp = fopen($filename, "a");
            $savetext = $submitNumber . "<>" . $name . "<>" . $comment . "<>" . date("Y/m/d H:i:s");
            fwrite($fp, $savetext.PHP_EOL);
            fclose($fp);
            echo $comment . " を受け付けました。<br>";
        } else if (!empty($_POST["deleteSubmit"]) && !empty($_POST["number"])) {
            $deleteNumber = $_POST["number"];
            $datas = file($filename, FILE_IGNORE_NEW_LINES);
            $fp = fopen($filename, "w");
            foreach ($datas as $data) {
                $displayDatas = explode("<>", $data);
                $commentNumber = $displayDatas[0];
                if ($deleteNumber != $commentNumber) {
                    fwrite($fp, $data.PHP_EOL);
                }
            }
            fclose($fp); 
        }
        if (file_exists($filename)) {
            $datas = file($filename, FILE_IGNORE_NEW_LINES);
            foreach ($datas as $data) {
                $displayDatas = explode("<>", $data);
                foreach ($displayDatas as $displayData) {
                    echo $displayData . " ";
                }
                echo "<br>";
            }
        }
    ?>
</body>
</html>