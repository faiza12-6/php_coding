<?php
// Q1: One-dimensional array
$a = array(5, -7, 12, 10, -7, 11, -6, 12, 1, -7, 2, 9);

echo "<h3>Q1: One-dimensional array</h3>";
echo "Elements: " . implode(", ", $a) . "<br>";

$total = 0; $even = 0; $odd = 0;
foreach ($a as $v) {
    $total += $v;
    if ($v % 2 == 0) $even += $v; else $odd += $v;
}
echo "Total of all elements = $total<br>";
echo "Total of even elements = $even<br>";
echo "Total of odd elements = $odd<br>";

$min = min($a);
$max = max($a);
$minPos = array(); $maxPos = array();
foreach ($a as $i => $v) {
    if ($v == $min) $minPos[] = $i;
    if ($v == $max) $maxPos[] = $i;
}
echo "Minimum element is $min in " . count($minPos) . " positions: [" . implode("], [", $minPos) . "]<br>";
echo "Maximum element is $max in " . count($maxPos) . " positions: [" . implode("], [", $maxPos) . "]<br>";

// Q2: Associative 2D array (colours)
$rows = array("Light", "Normal", "Dark");
$cols = array("Red", "Green", "Blue");
$colors = array();
foreach ($rows as $r)
    foreach ($cols as $c)
        $colors[$r][$c] = "$r $c";

echo "<h3>Q2: Colours</h3>";
echo "<table border='1' cellpadding='6' cellspacing='0'>";
echo "<tr><th></th>";
foreach ($cols as $c) echo "<th>$c</th>";
echo "</tr>";
foreach ($colors as $r => $line) {
    echo "<tr><th>$r</th>";
    foreach ($line as $val) echo "<td>$val</td>";
    echo "</tr>";
}
echo "</table>";


// Q3: Square 2D array
$m = array(
    array(2, -6, 8),
    array(-6, 1, 6),
    array(7, 8, -6)
);
$n = count($m);

$odd = 0; $even = 0; $all = 0;
$rowT = array_fill(0, $n, 0);
$colT = array_fill(0, $n, 0);
$d1 = 0; $d2 = 0;
$min = $m[0][0]; $max = $m[0][0];

for ($i = 0; $i < $n; $i++) {
    for ($j = 0; $j < $n; $j++) {
        $v = $m[$i][$j];
        $all += $v;
        if ($v % 2 == 0) $even += $v; else $odd += $v;
        $rowT[$i] += $v;
        $colT[$j] += $v;
        if ($i == $j) $d1 += $v;            // main diagonal
        if ($i + $j == $n - 1) $d2 += $v;   // anti diagonal
        if ($v < $min) $min = $v;
        if ($v > $max) $max = $v;
    }
}
$minPos = array(); $maxPos = array();
for ($i = 0; $i < $n; $i++)
    for ($j = 0; $j < $n; $j++) {
        if ($m[$i][$j] == $min) $minPos[] = "[$i,$j]";
        if ($m[$i][$j] == $max) $maxPos[] = "[$i,$j]";
    }

$span = $n + 2;
$g = "style='background:#999;text-align:center'";
echo "<h3>Q3: Square array</h3>";
echo "<table border='1' cellpadding='6' cellspacing='0' style='text-align:center'>";
echo "<tr><td colspan='$span'>Total odd elements = $odd</td></tr>";
echo "<tr><td colspan='$span'>Total even elements = $even</td></tr>";
// top row: diagonal2 ... column totals ... diagonal1
echo "<tr><td $g>$d1</td>";
foreach ($colT as $t) echo "<td>$t</td>";
echo "<td $g>$d2</td></tr>";
// matrix rows with row totals on both sides
for ($i = 0; $i < $n; $i++) {
    echo "<tr><td>{$rowT[$i]}</td>";
    for ($j = 0; $j < $n; $j++) echo "<td>{$m[$i][$j]}</td>";
    echo "<td>{$rowT[$i]}</td></tr>";
}
// bottom row
echo "<tr><td $g>$d2</td>";
foreach ($colT as $t) echo "<td>$t</td>";
echo "<td $g>$d1</td></tr>";
echo "<tr><td colspan='$span'>Total all elements = $all</td></tr>";
echo "<tr><td colspan='$span'>Min element is: $min in " . count($minPos) . " positions:<br>" . implode(", ", $minPos) . "</td></tr>";
echo "<tr><td colspan='$span'>Maximum element is: $max in " . count($maxPos) . " positions:<br>" . implode(", ", $maxPos) . "</td></tr>";
echo "</table>";


// Q4: Associative 2D array (students)
// NOTE: array keys must be unique, so the 3rd ID is CA224 (the PDF repeats CA221).
$students = array(
    "CA221" => array("Name" => "Mohamed Ahmed Ali", "Phone" => "0648440403", "Address" => "Laba Dhagax, Wardhiigley"),
    "CA223" => array("Name" => "Ahmed Abdi Jama",   "Phone" => "0647223201", "Address" => "Taleex, Hodan"),
    "CA224" => array("Name" => "Amina Nur Adan",    "Phone" => "0646990276", "Address" => "Macmacaanka, Dharkeynley")
);
$cols = array("Name", "Phone", "Address");

echo "<h3>Q4: Students</h3>";
echo "<table border='1' cellpadding='6' cellspacing='0'>";
echo "<tr style='background:#ddd'><th></th>";
foreach ($cols as $c) echo "<th>$c</th>";
echo "</tr>";
foreach ($students as $id => $info) {
    echo "<tr><td style='background:#ddd'>$id</td>";
    foreach ($cols as $c) echo "<td>{$info[$c]}</td>";
    echo "</tr>";
}
echo "</table>";


// Q5: Student transcript

$transcript = array(
    "Semester 1" => array(
        "subject1" => array(9, 26, 10, 40),
        "subject2" => array(9, 26, 10, 40),
        "subject3" => array(9, 26, 10, 40)
    ),
    "Semester 2" => array(
        "subject1" => array(9, 26, 10, 0),
        "subject2" => array(9, 26, 10, 40),
        "subject3" => array(9, 26, 10, 40)
    )
);

echo "<h3>Q5: Student transcript</h3>";
echo "<table border='1' cellpadding='6' cellspacing='0'>";
echo "<tr><th>Semester</th><th>Course</th><th>CW1</th><th>MidTerm</th><th>CW2</th><th>Final</th><th>Total</th><th>Status</th></tr>";
foreach ($transcript as $sem => $courses) {
    $first = true;
    foreach ($courses as $course => $marks) {
        $total = array_sum($marks);
        $status = ($total >= 50) ? "Pass" : "Fail";
        echo "<tr>";
        if ($first) {
            echo "<th rowspan='" . count($courses) . "'>$sem</th>";
            $first = false;
        }
        echo "<td>$course</td>";
        foreach ($marks as $mk) echo "<td align='right'>$mk</td>";
        echo "<td align='right'>$total</td><td>$status</td></tr>";
    }
}
echo "</table>";

?>