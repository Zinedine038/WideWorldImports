<?php

//start session
session_start();

require_once("./php/component.php");
require_once("./php/databasefunctions.php");
$database = new CreateDb("");

if(isset($_POST['add']))
{
    include_once("../functions.php");
    print($name = sql("stockitems","stockitemname",$_POST["product_id"]));
    //print_r($_POST['product_id']);
    if(isset($_SESSION['cart']))
    {
        $item_array_id = array_column($_SESSION['cart'],"product_id");

        if(in_array(($_POST['product_id']), $item_array_id))
        {
            $name = sql("stockitems","stockitemname",$_POST["product_id"]);
            $keyIndex = getparent($_SESSION['cart'],$name);
            $_SESSION['cart'][$keyIndex]['amount']+=1;
        }
        else
        {
            $count=count($_SESSION['cart']);
            $name = sql("stockitems","stockitemname",$_POST["product_id"]);
            $item_array=array('product_id' => $_POST['product_id'],
                'amount' => 1,
                'name' => $name  );
            $_SESSION['cart'][$count]=$item_array;
        }
    }
    else
    {
        $name = sql("stockitems","stockitemname",$_POST["product_id"]);
        $item_array=array('product_id' => $_POST['product_id'],
            'amount' => 1,
            'name' => $name);
        $_SESSION['cart'][0] = $item_array;
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php require_once ("php/header.php"); ?>
    <div class="container">
        <div class="row text-center py-5">
            <?php
            $result = $database->getData();
            while($row = mysqli_fetch_assoc($result))
            {
                component($row["StockItemName"],$row["UnitPrice"],"./upload/product1.png",$row["MarketingComments"],$row["StockItemID"]);
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>