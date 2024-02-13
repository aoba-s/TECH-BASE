<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-01</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="comment" placeholder="コメント">
        <input type="submit" name="submit">
    </form>
    <?php
        if(!empty($_POST["comment"])) {
            $comment = $_POST["comment"];
            echo $comment . " を受け付けました。";
        }
    ?>
</body>
</html>