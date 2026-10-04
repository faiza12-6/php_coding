<?php

// QUESTION 1 

echo "<h2 style='color: darkorange;'>Question 1: Greatest and Smallest Number</h2>";

// // This question is about comparing three numbers and finding the greatest and smallest number.


echo "<p style='color: black;'>Answer:</p>";

$a = 25;
$b = 10;
$c = 40;

$greatest = $a;
$smallest = $a;

if ($b > $greatest) {
    $greatest = $b;
}

if ($c > $greatest) {
    $greatest = $c;
}

if ($b < $smallest) {
    $smallest = $b;
}

if ($c < $smallest) {
    $smallest = $c;
}

echo "Greatest: $greatest <br>";
echo "Smallest: $smallest";

echo "<hr>";


//  QUESTION 2 

echo "<h2 style='color: navy;'>Question 2: Divisible by 3 and 5</h2>";


// This question is about checking whether a number is divisible by 3, 5, both, or neither.


echo "<p style='color: dark;'>Answer:</p>";

$number = 15;

if ($number % 3 == 0 && $number % 5 == 0) {
    echo "The number is divisible by both 3 and 5.";
}
elseif ($number % 3 == 0) {
    echo "The number is divisible by 3.";
}
elseif ($number % 5 == 0) {
    echo "The number is divisible by 5.";
}
else {
    echo "The number is divisible by neither 3 nor 5.";
}

echo "<hr>";

// QUESTION 3 

echo "<h2 style='color: darkorange;'>Question 3: Odd and Even Numbers</h2>";


// This question is about printing odd numbers from 2 to 20 and even numbers from 35 to 7.


echo "<p style='color: black;'>Answer:</p>";

echo "Odd numbers: ";

for ($i = 2; $i <= 20; $i++) {

    if ($i % 2 != 0) {
        echo $i . " ";
    }

}

echo "<br><br>";

echo "Even numbers: ";

for ($i = 35; $i >= 7; $i--) {

    if ($i % 2 == 0) {
        echo $i . " ";
    }

}

echo "<hr>";

//  QUESTION 4

echo "<h2 style='color: navy;'>Question 4: Numbers Divisible by 2 and 5</h2>";


// This question is about finding numbers between 50 and 2 that are divisible by both 2 and 5.


echo "<p style='color: black;'>Answer:</p>";

for ($i = 50; $i >= 2; $i--) {

    if ($i % 2 == 0 && $i % 5 == 0) {
        echo $i . " ";
    }

}

echo "<hr>";

//  QUESTION 5 

echo "<h2 style='color: darkorange;'>Question 5: Reverse of a Number</h2>";


// This question is about reversing a given number without using the strrev() function.


echo "<p style='color: black;'>Answer:</p>";

$number = 12345;
$reverse = 0;

while ($number > 0) {

    $digit = $number % 10;

    $reverse = ($reverse * 10) + $digit;

    $number = (int)($number / 10);

}

echo "Reverse: " . $reverse;

echo "<hr>";

//  QUESTION 6

echo "<h2 style='color: navy;'>Question 6: LCM</h2>";


// This question is about calculating the Least Common Multiple (LCM) of two positive numbers.


echo "<p style='color: black;'>Answer:</p>";

$a = 8;
$b = 12;

if ($a > $b) {
    $lcm = $a;
}
else {
    $lcm = $b;
}

while (true) {

    if ($lcm % $a == 0 && $lcm % $b == 0) {
        break;
    }

    $lcm++;
}

echo "LCM: " . $lcm;

echo "<hr>";

//  QUESTION 7 
echo "<h2 style='color: darkorange;'>Question 7: HCF</h2>";


// This question is about calculating the Highest Common Factor (HCF) of two numbers.


echo "<p style='color: black;'>Answer:</p>";

$a = 18;
$b = 24;

$hcf = 1;

if ($a < $b) {
    $limit = $a;
}
else {
    $limit = $b;
}

for ($i = 1; $i <= $limit; $i++) {

    if ($a % $i == 0 && $b % $i == 0) {
        $hcf = $i;
    }

}

echo "HCF: " . $hcf;

echo "<hr>";

// QUESTION 8 

echo "<h2 style='color: navy;'>Question 8: Multiplication Table</h2>";


// This question is about creating a multiplication table up to 12 x 12 using nested loops.


echo "<p style='color: black;'>Answer:</p>";

echo "<table border='1'>";

for ($i = 1; $i <= 12; $i++) {

    echo "<tr>";

    for ($j = 1; $j <= 12; $j++) {

        echo "<td>";
        echo $i * $j;
        echo "</td>";

    }

    echo "</tr>";
}

echo "</table>";

echo "<hr>";

//  QUESTION 9

echo "<h2 style='color: darkorange;'>Question 9: Prime or Non-Prime</h2>";


// This question is about checking whether a given number is prime or non-prime.


echo "<p style='color: black;'>Answer:</p>";

$number = 17;

$isPrime = true;

if ($number < 2) {
    $isPrime = false;
}

for ($i = 2; $i < $number; $i++) {

    if ($number % $i == 0) {

        $isPrime = false;

        break;
    }
}

if ($isPrime) {
    echo "Prime number";
}
else {
    echo "Non-prime number";
}

echo "<hr>";

// QUESTION 10 

echo "<h2 style='color: navy;'>Question 10: Prime Numbers from 10 to 50</h2>";

// This question is about printing all prime numbers between 10 and 50.


echo "<p style='color: black;'>Answer:</p>";

for ($number = 10; $number <= 50; $number++) {

    $isPrime = true;

    for ($i = 2; $i < $number; $i++) {

        if ($number % $i == 0) {

            $isPrime = false;

            break;
        }
    }

    if ($isPrime) {
        echo $number . " ";
    }
}

?>