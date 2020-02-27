<!DOCTYPE html>
<html lang=ru>
<head>
    <meta charset=utf-8>
    <title>ДЗ №3</title>
</head>
<body>
<?php

require('src/functions.php');

// task 3.1
echo '<h3>Задание 3.1</h3>';
task1('data.xml');

// task 3.2
echo '<h3>Задание 3.2</h3>';

$cars = [['name' => 'Jeep', 'model' => 'Grand Cherokee'], ['name' => 'Mitsubishi', 'model' => 'Pajero Sport'], ['name' => 'Toyota', 'model' => 'FJ Cruiser']];

file_put_contents("output.json", json_encode($cars));
$cars2 = json_decode(file_get_contents("output.json"), true);
$change = rand(0, 1);
if ($change) {
    $cars2[2] = ['name' => 'Toyota', 'model' => '4Runner'];
    $cars2[] = ['name' => 'Nissan', 'model' => 'Patrol'];
    echo 'Данные были изменены';
} else {
    echo 'Данные не были изменены';
}
file_put_contents("output2.json", json_encode($cars2));
echo '<br><br>Разница в данных: ';
$diff = array_udiff($cars2, $cars, 'compare_arr');
if (sizeof($diff) == 0) {
    echo 'не обнаружена';
} else {
    echo '<pre>';
    print_r($diff);
}

// task 3.3
echo '<h3>Задание 3.3</h3>';
$csv = task3(1, 100, 50);
if (file_exists($csv) && (($handle = fopen($csv, "r")) !== false)) {
    while (($data = fgetcsv($handle, 1000, ";")) !== false) {
        $num = count($data);
        $sum = 0;
        for ($c = 0; $c < $num; $c++) {
            if ($data[$c] % 2 == 0) {
                $sum += $data[$c];
            }
        }
    }
    fclose($handle);
    echo 'Сумма четных чисел из файла '.$csv.' = '.$sum;
}

// task 3.4
echo '<h3>Задание 3.4</h3>';
$source = 'https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json';
$params = ['pageid', 'title'];
task4($source, $params);

?>
</body>
</html>
