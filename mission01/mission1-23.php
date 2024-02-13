<?php
    $employees = array("Ken", "Alice", "Judy", "BOSS", "Bob");
    foreach ($employees as $employee) {
        if ($employee == "BOSS") {
            echo "Good morning " . $employee . "!<br>";
        } else {
            echo "Hi! " . $employee . "<br>";
        }
    }
?>