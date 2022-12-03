<?php
//阅读相册。从本地磁盘获取Json文件
$strJSONContents = file_get_contents("cars.json");

//解码:
// $strJSONContents: input string
//当第二个参数为true时，JSON对象将作为关联数组返回;
//当第二个参数为false时，JSON对象将作为对象返回。
$array = json_decode($strJSONContents, true);

//遍历相册集合，并每年添加一个
/*
foreach ($array["cars"] as &$car) {
    $car['year'] += 1;
}
*/

$newStr = json_encode($array);
$newStrPretty = json_encode($array, JSON_PRETTY_PRINT);

//返回$newStr。“\ n”;
//返回$newStrPretty。“\ n”;;
header('Content-Type: application/json');
echo $newStrPretty;
?>