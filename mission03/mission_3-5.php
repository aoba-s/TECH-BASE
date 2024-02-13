<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-05</title>
</head>
<body>
    <?php
        $filename = "mission_3-5.txt";
        if (!empty($_POST["fixSubmit"]) && !empty($_POST["fixNumber"]) && !empty($_POST["fixPassword"])) {
            $fixPassword = $_POST["fixPassword"];
            $fixNumber = $_POST["fixNumber"];
            $datas = file($filename, FILE_IGNORE_NEW_LINES);
            $canFix = false;
            foreach ($datas as $data) {
                $displayDatas = explode("<>", $data);
                $commentNumber = $displayDatas[0];
                $commentPassword = $displayDatas[4];
                if ($fixNumber == $commentNumber && $fixPassword == $commentPassword) {
                    $postName = $displayDatas[1];
                    $postComment = $displayDatas[2];
                    $postPassword = $displayDatas[4];
                    $canFix = true;
                    break;
                }
            }
            if ($canFix) {
                $fixTextMessage = "編集してください。<br>";
            } else {
                $fixTextMessage = "投稿番号やパスワードを確認してください。<br>";
            }
        }
    ?>
    <h1>掲示板のテーマ: 好きな食べ物</h1>
    <form action="" method="post">
        <p>投稿（パスワードが未入力の場合、投稿の編集・削除ができません。）</p>
        <input type="text" name="name" placeholder="名前" value=<?= isset($postName) ? $postName : '' ?>>
        <input type="text" name="comment" placeholder="コメント" value=<?= isset($postComment) ? $postComment : '' ?>>
        <input type="password" name="password" placeholder="パスワード" value=<?= isset($postPassword) ? $postPassword : '' ?>>
        <input type="hidden" name="commentNumber" placeholder="投稿種別" value=<?= isset($commentNumber) ? $commentNumber : '' ?>>
        <input type="submit" name="commentSubmit" value="投稿">
    </form>
    <form action="" method="post">
        <p>編集</p>
        <input type="text" name="fixNumber" placeholder="投稿番号">
        <input type="password" name="fixPassword" placeholder="パスワード">
        <input type="submit" name="fixSubmit" value="編集">
    </form>
    <form action="" method="post">
        <p>削除</p>
        <input type="text" name="deleteNumber" placeholder="投稿番号">
        <input type="password" name="deletePassword" placeholder="パスワード">
        <input type="submit" name="deleteSubmit" value="削除">
    </form>
    <?php
        if (!empty($fixTextMessage)) {
            echo $fixTextMessage;
        }
        if (!empty($_POST["commentSubmit"]) && !empty($_POST["name"]) && !empty($_POST["comment"])) {
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            $password = $_POST["password"];
            $commentNumber = $_POST["commentNumber"];
            if (empty($commentNumber)) {
                if (file_exists($filename)) {
                    $datas = file($filename, FILE_IGNORE_NEW_LINES);
                    $lastData = explode("<>", end($datas));
                    $submitNumber = $lastData[0] + 1;
                } else {
                    $submitNumber = 1;
                }
                $fp = fopen($filename, "a");
                $savetext = $submitNumber . "<>" . $name . "<>" . $comment . "<>" . date("Y/m/d H:i:s") . "<>" . $password . "<>";
                fwrite($fp, $savetext.PHP_EOL);
                fclose($fp);
                echo $comment . " を受け付けました。<br>";
            } else {
                $fixPassword = $_POST["password"];
                $fixNumber = $_POST["commentNumber"];
                $datas = file($filename, FILE_IGNORE_NEW_LINES);
                $fp = fopen($filename, "w");
                foreach ($datas as $data) {
                    $displayDatas = explode("<>", $data);
                    $commentNumber = $displayDatas[0];
                    if ($fixNumber == $commentNumber) {
                        $date = $displayDatas[3];
                        $savetext = $commentNumber . "<>" . $name . "<>" . $comment . "<>" . $date . "<>" . $fixPassword . "<>";
                        fwrite($fp, $savetext.PHP_EOL);
                    } else {
                        fwrite($fp, $data.PHP_EOL);
                    }
                }
                fclose($fp);
                echo "編集しました。<br>";
            }
        } else if (!empty($_POST["deleteSubmit"]) && !empty($_POST["deleteNumber"]) && !empty($_POST["deletePassword"])) {
            $deletePassword = $_POST["deletePassword"];
            $deleteNumber = $_POST["deleteNumber"];
            $datas = file($filename, FILE_IGNORE_NEW_LINES);
            $canDelete = false;
            foreach ($datas as $data) {
                $displayDatas = explode("<>", $data);
                $commentNumber = $displayDatas[0];
                $commentPassword = $displayDatas[4];
                if ($deleteNumber == $commentNumber && $deletePassword == $commentPassword) {
                    $canDelete = true;
                }
            }
            if ($canDelete) {
                $fp = fopen($filename, "w");
                foreach ($datas as $data) {
                    $displayDatas = explode("<>", $data);
                    $commentNumber = $displayDatas[0];
                    if ($deleteNumber != $commentNumber) {
                        fwrite($fp, $data.PHP_EOL);
                    }
                }
                fclose($fp); 
                echo "削除しました。<br>";
            } else {
                echo "投稿番号やパスワードを確認してください。<br>";
            }
        }
        
        if (file_exists($filename)) {
            $datas = file($filename, FILE_IGNORE_NEW_LINES);
            echo "<p>投稿一覧</p>";
            foreach ($datas as $data) {
                $displayDatas = explode("<>", $data);
                echo $displayDatas[0] . " " . $displayDatas[1] . " " . $displayDatas[2] . " " . $displayDatas[3] . "<br>";
            }
        }
    ?>
</body>
</html>