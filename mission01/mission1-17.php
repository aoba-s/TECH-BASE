<?php
    $num = 15;
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