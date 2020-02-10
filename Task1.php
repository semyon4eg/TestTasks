<?php
$array = [6, 10, 9, 5, 3, 1, 8];
$max = $array[0];
$min = $array[0];
foreach ($array as $value) {
    if ($max < $value) {
        $max = $value;
    } elseif ($min > $value) {
        $min = $value;
    }
}
echo "Максимальное значение в массиве: $max, минимальное значение: $min";