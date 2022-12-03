<?php
$strJSONContents = file_get_contents("cars.json");
$array = json_decode($strJSONContents, true);
session_start();
// var_dump($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Detail and Cost Page</title>
</head>

<style>
.padd {
    margin: 10px;
    padding: 10px;
    width: 80%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -80%);

}

body {}
</style>

<body>

    <!-- <div class="contrainer-fluid"> -->
    <div class="padd">
        <div class="column">
            <h2 class="text-center">Rent Car Display</h2>

            <table class='table table-bordered table-striped table-hover table-condensed'>
                <tr>
                    <th>&nbsp; Name</th>
                    <th>Mailing address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Post-code</th>
                    <th>Payment Type</th>
                <tr>

                <tr>
                    <td>&nbsp;&nbsp;<?=$_GET['name']?></td>
                    <td><?=$_GET['mailing-address']?></td>
                    <td><?=$_GET['city']?></td>
                    <td><?=$_GET['state']?></td>
                    <td><?=$_GET['post-code']?></td>
                    <td><?=$_GET['payment-type']?></td>
                <tr>

            </table>

            <h2 class="text-center">Rent Car Select</h2>
            <?php 

                        $total = 0;
                        $output = "";
                        $output .= "
                        <table class='table table-bordered table-striped table-hover table-condensed'>
                                <tr>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Model year</th>
                                <th>Mileage</th>
                                <th>Fuel type</th>
                                <th>Seats</th>
                                <th>Price</th>
                                <th>Rent Day</th>
                                <th>Total Price</th>
                                <tr>
                        ";

                        
                        if(!empty($_SESSION['cart'])){
                            foreach($_SESSION['cart'] as $key =>$value){
                                foreach ($array["cars"] as &$car) {
                                if($value['model'] == $car["Model"]){
                                $output .= "
                                <tr>
                                    <td>".$value['brand']."</td>
                                    <td>".$value['model']."</td>
                                    <td>".$car["Model year"]."</td>
                                    <td>".$car["Mileage"]."</td>
                                    <td>".$car["Fuel type"]."</td>
                                    <td>".$car["Seats"]."</td>
                                    <td>$".$value['price']."</td>
                                    <td>".$value['renTime']."</td>
                                    <td>$".number_format($value['price']*$value['renTime'])."</td>
                                    
                                ";

                                $total = $total + $value['price'] * $value['renTime'];
                                }
                            }
                        }
                            $output .= "
                                <tr>
                                    <td colspan='7'></td>
                                    <td></b>Total Price</b></td>
                                    <td>$" .number_format($total, 1)."</td>
                                </tr>
                            ";
                        
                            $output .= "
                            <tr>
                                <td colspan='8'></td>
                                <td>
                                    <a href='index.php?action=clearall'>
                                    <button class='btn btn-success btn-block'>Finish</button>
                                    </a>
                                </td>
                            </tr>
                        ";
                        
                            
                                }
                        echo $output;
                    ?>
        </div>
    </div>
</body>

</html>