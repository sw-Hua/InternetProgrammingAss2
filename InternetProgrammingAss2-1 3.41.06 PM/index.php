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
    // $car['year'] += 1;
    echo $car["Brand"];
    echo "<br>";
}
*/
/*
$newStr = json_encode($array);
$newStrPretty = json_encode($array, JSON_PRETTY_PRINT);

//返回$newStr。“\ n”;
//返回$newStrPretty。“\ n”;;
header('Content-Type: application/json');
echo $newStrPretty;
*/
session_start();
if(isset($_GET['add_to_cart']) ){
    if(isset($_SESSION['cart'])){
        $session_array_model = array_column($_SESSION['cart'], "model");

        if(!in_array($_GET['model'], $session_array_model)){
            if($_GET['availability'] == "Y"){
                $session_array = array(
                    "brand" => $_GET['brand'],
                    "model" => $_GET['model'],
                    "price" => $_GET['price'],
                    "availability" => $_GET['availability'],
                    "renTime" => $_GET['renTime']
                );
                $_SESSION['cart'][] = $session_array;
            }else{
                echo "<script>alert('Sorry, the car is not available now. Please try other cars');</script>";
            }
        }
    }else{
        // 第一次进来回到这里
        if($_GET['availability'] == "Y"){
            $session_array = array(
                "brand" => $_GET['brand'],
                "model" => $_GET['model'],
                "price" => $_GET['price'],
                "availability" => $_GET['availability'],
                "renTime" => $_GET['renTime']
            );
            $_SESSION['cart'][] = $session_array;
        }else{
            echo "<script>alert('Sorry, the car is not available now. Please try other cars');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Car Rental Center</title>
</head>
<style>
body {}

.myForm {
    background-color: white;
    margin: 10px;
    padding: 10px;
    border-radius: 20px;
    background-color: white;
    opacity: 0.98;
    box-shadow: 0 0 20px white;
    text-align: center;
}

.myform2 {
    margin: 10px;
    padding: 10px;
}

.bck {
    background-color: #F2F2F2;
}

.navi {
    background-color: #1C1C1C;
    color: white;
    border-radius: 10px;
    padding: 10px;
    margin: 10px;
}

.navi {
    background-color: #1C1C1C;
    color: white;
    border-radius: 10px;
    padding: 10px;
    margin: 10px;
}
</style>

<body>
    <?php
    if(isset($_GET['action'])){

        if($_GET['action'] == "clearall"){
            unset($_SESSION['cart']);
        }
        if($_GET['action'] == "remove"){
            foreach($_SESSION['cart'] as $key => $value){
                if($value['model'] == $_GET['model']){
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
    }
?>

    <div class="contrainer-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8 bck">
                    <div class="navi">
                        <h2 class="text-center">Rent Car Display</h2>
                    </div>
                    <div class="col-md-12">
                        <div class="row">



                            <?php foreach ($array["cars"] as &$car) {?>
                            <div class="col-md-4">
                                <div class="myForm">
                                    <form method="get" action="index.php?model=<?=$car["Model"]?>">
                                        <image src="images/<?=$car["Model"]?>.jpeg">
                                            <h5><?=$car["Brand"]?> <?=$car["Model"]?></h5>
                                            </br>
                                            <p>Price: $<?=$car["Price Description per day"]?> /day</p>
                                            <p>Current availability: <?=$car["Availability"]?></p>
                                            <p><?=$car["Description"]?></p>

                                            <input type="hidden" name="brand" value="<?=$car["Brand"]?>">
                                            <input type="hidden" name="model" value="<?=$car["Model"]?>">
                                            <input type="hidden" name="price"
                                                value="<?=$car["Price Description per day"]?>">
                                            <input type="hidden" name="availability" value="<?=$car["Availability"]?>">

                                            <div class="form-group">
                                                <input type="number" name="renTime" value="1" class="form-cotrol"
                                                    class="form-control">
                                            </div>
                                            </br>
                                            <input type="submit" name="add_to_cart"
                                                class="btn btn-success btn-block my2" value="Add to Cart">
                                    </form>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="navi">
                        <h2 class="text-center">Rent Car Select</h2>
                    </div>
                    <div class="myform2">
                        <?php 

                        $total = 0;
                        $output = "";
                        $output .= "
                        <table class='table table-hover table-bordered table-striped  table-condensed'>
                                <tr>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Availability</th>
                                <th>Price</th>
                                <th>Rent Day</th>
                                <th>Total Price</th>
                                <th>Action</th>
                                <tr>
                        ";
                        if(!empty($_SESSION['cart'])){
                            foreach($_SESSION['cart'] as $key =>$value){
                                $output .= "
                                <tr>
                                    <td>".$value['brand']."</td>
                                    <td>".$value['model']."</td>
                                    <td>".$value['availability']."</td>
                                    <td>".$value['price']."</td>
                                    <td>".$value['renTime']."</td>
                                    <td>$".number_format($value['price']*$value['renTime'])."</td>
                                    <td>
                                        <a href='index.php?action=remove&model=" .$value['model']."'>
                                        <button class='btn btn-danger btn-block'>Remove</button>
                                        </a>
                                    </td>
                                ";

                                $total = $total + $value['price'] * $value['renTime'];
                            }
                            $output .= "
                                <tr>
                                    <td colspan='4'></td>
                                    <td></b>Total Price</b></td>
                                    <td>$" .number_format($total, 1)."</td>
                                    <td>
                                        <a href='index.php?action=clearall'>
                                        <button class='btn btn-warning btn-block'>Clear All</button>
                                        </a>
                                    </td>
                                </tr>
                            ";
                            
                            $output .= "
                            <tr>
                                <td colspan='6'></td>
                                <td>
                                    <a href='checkout.php'>
                                    <button class='btn btn-success btn-block'>Checkout</button>
                                    </a>
                                </td>
                            </tr>
                        ";
                        }
                        echo $output;
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>