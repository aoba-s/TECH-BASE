<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-04</title>
</head>
<body>
    <?php
        $filename = "mission_3-4.txt";
        if (!empty($_POST["fixSubmit"]) && !empty($_POST["fixNumber"])) {
            $fixNumber = $_POST["fixNumber"];
            $datas = file($filename, FILE_IGNORE_NEW_LINES);
            foreach ($datas as $data) {
                $displayDatas = explode("<>", $data);
                $commentNumber = $displayDatas[0];
                if ($fixNumber == $commentNumber) {
                    $postName = $displayDatas[1];
                    $postComment = $displayDatas[2];
                    break;
                }
            }
        }
    ?>
    <form action="" method="post">
        <p>投稿</p>
        <input type="text" name="name" placeholder="名前" value=<?= isset($postName) ? $postName : '' ?>>
        <input type="text" name="comment" placeholder="コメント" value=<?= isset($postComment) ? $postComment : '' ?>>
        <input type="hidden" name="commentNumber" placeholder="投稿種別" value=<?= isset($commentNumber) ? $commentNumber : '' ?>>
        <input type="submit" name="commentSubmit" value="投稿">
    </form>
    <form action="" method="post">
        <p>編集</p>
        <input type="text" name="fixNumber" placeholder="投稿番号">
        <input type="submit" name="fixSubmit" value="編集">
    </form>
    <form action="" method="post">
        <p>削除</p>
        <input type="text" name="deleteNumber" placeholder="投稿番号">
        <input type="submit" name="deleteSubmit" value="削除">
    </form>
    <?php
        if (!empty($_POST["commentSubmit"]) && !empty($_POST["name"]) && !empty($_POST["comment"])) {
            $commentNumber = $_POST["commentNumber"];
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            if (empty($commentNumber)) {
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
            } else {
                $fixNumber = $_POST["commentNumber"];
                $datas = file($filename, FILE_IGNORE_NEW_LINES);
                $fp = fopen($filename, "w");
                foreach ($datas as $data) {
                    $displayDatas = explode("<>", $data);
                    $commentNumber = $displayDatas[0];
                    if ($fixNumber == $commentNumber) {
                        $date = $displayDatas[3];
                        $savetext = $commentNumber . "<>" . $name . "<>" . $comment . "<>" . $date;
                        fwrite($fp, $savetext.PHP_EOL);
                    } else {
                        fwrite($fp, $data.PHP_EOL);
                    }
                }
                fclose($fp); 
            }
        } else if (!empty($_POST["deleteSubmit"]) && !empty($_POST["deleteNumber"])) {
            $deleteNumber = $_POST["deleteNumber"];
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