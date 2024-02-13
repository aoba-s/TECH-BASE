<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-21</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="num" placeholder="数字を入力してね">
        <input type="submit" name="submit">
    </form>
    <?php
        $num = $_POST["num"];
        if($num%15==0) {
            echo "FizzBuzz<br>";
        } else if ($num%3==0) {
            echo "Fizz<br>";
        } else if ($num%5==0) {
            echo "Buzz<br>";
        } else {
            echo $num . "<br>";
        }
    ?>
</body>
</html>