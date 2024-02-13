<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5</title>
</head>
<body>
    <?php
        //接続情報
        $dsn = 'mysql:dbname=xxx;host=localhost';
        $user = 'xxx';
        $password = 'xxx';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

        //テーブル作成（テーブルが存在しない場合）
        $sql = "CREATE TABLE IF NOT EXISTS tbBBS"
        ." ("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "name CHAR(32),"
        . "comment TEXT,"
        . "datetime DATETIME,"
        . "password TEXT"
        .");";
        $stmt = $pdo -> query($sql);
        
        //編集
        if (!empty($_POST["fixSubmit"]) && !empty($_POST["fixNumber"]) && !empty($_POST["fixPassword"])) {
            $id = $_POST["fixNumber"];
            $sql = 'SELECT * from tbBBS where id=:id';
            $stmt = $pdo -> prepare($sql);
            $stmt -> bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt -> fetch(PDO::FETCH_ASSOC);
            $password = $result["password"];
            if ($password == $_POST["fixPassword"]) {
                $postName = $result["name"];
                $postComment = $result["comment"];
                $postPassword = $result["password"];
                $commentNumber = $result["id"];
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
        //投稿
        if (!empty($_POST["commentSubmit"]) && !empty($_POST["name"]) && !empty($_POST["comment"])) {
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            $password = $_POST["password"];
            //新規
            if(empty($_POST["commentNumber"])) {
                $datetime = date("Y/m/d H:i:s");
                $sql = "INSERT INTO tbBBS (name, comment, datetime, password) VALUES (:name, :comment, :datetime, :password)";
                $stmt = $pdo -> prepare($sql);
                $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
                $stmt -> bindParam(':comment', $comment, PDO::PARAM_STR);
                $stmt -> bindParam(':datetime', $datetime, PDO::PARAM_STR);
                $stmt -> bindParam(':password', $password, PDO::PARAM_STR);
                $stmt -> execute();
            }
            //更新
            else {
                $id = $_POST["commentNumber"];
                $sql = 'UPDATE tbBBS SET name=:name,comment=:comment,password=:password WHERE id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            }
        }
        
        //削除
        if (!empty($_POST["deleteSubmit"]) && !empty($_POST["deleteNumber"]) && !empty($_POST["deletePassword"])) {
            //パスワード取得
            $id = $_POST["deleteNumber"];
            $sql = 'SELECT * from tbBBS where id=:id';
            $stmt = $pdo -> prepare($sql);
            $stmt -> bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt -> fetch(PDO::FETCH_ASSOC);
            $password = $result["password"];
            //パスワード確認
            if ($password == $_POST["deletePassword"]) {
                //投稿削除
                $sql = 'delete from tbBBS where id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            }
        }
        
        //投稿一覧
        $sql = 'SELECT * FROM tbBBS';
        $stmt = $pdo -> query($sql);
        $results = $stmt -> fetchAll();
        echo "<p>投稿一覧</p>";
        foreach ($results as $row) {
            echo $row['id'] . " " . $row['name'] . " " . $row['comment'] . " " . date("Y/m/d H:i:s", strtotime($row['datetime'])) . "<br>";
        }
    ?>
</body>
</html>