<?php

$count = 1;

while ($count <= 15) {

    echo "$count, ";
    $count++;

}

echo "<br>";

$i = 1;

while ($i <= 12) {
    echo "12 * $i = " . 12 * $i . "<br>";
    $i++;
}

echo "<br>";

$week = 3;
$day = 7;

for ($i = 1; $i <= $week; $i++) {

    echo "Week $i: <br>";

    for ($j = 1; $j <= $day; $j++) {
        echo "&nbsp; &nbsp;Day $j <br>";
    }

}



?>