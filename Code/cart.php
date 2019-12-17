<?php

    //Start cart session
    session_start();

    //Get manditory functions
    require_once("./functions.php");
    require_once("./Winkelmandje/php/Component.php");

    $errorMSG="";

    //creates an object database
    $db = new CreateDb("");
    if(isset($_SESSION['cart']))
    {
        //updates the array
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    //Remove an item
    if(isset($_POST['remove']))
    {
        if($_GET['action']=='remove')
        {
            foreach($_SESSION['cart'] as $key => $value)
            {
                if($value["product_id"] == $_GET['id'])
                {
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
    }
    //Add an item to an existing product
    if(isset($_POST['addOne']))
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value["product_id"] == $_GET['id'])
            {
                $stock=sql("stockitemholdings", "QuantityOnHand", $_SESSION['cart'][$key]['product_id']);
                if($_SESSION['cart'][$key]['amount']+1<=$stock)
                {
                    $_SESSION['cart'][$key]['amount']+=1;
                }
                else
                {
                    $errorMSG="Het door u ingevoerde getal is meer dan de huidige voorraad!" . "<br>" . "Huidige voorraad:" . $stock;
                }
            }
        }
    }
    //Remove one from an existing product IF the current amount is more than 1
    if(isset($_POST['removeOne']))
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value["product_id"] == $_GET['id'])
            {
                if($_SESSION['cart'][$key]['amount']>1)
                {
                    $_SESSION['cart'][$key]['amount']-=1;
                }
            }
        }
    }

    if(isset($_POST['newAmount']))
    {
        if(preg_match("/[a-z]/i", $_POST['newAmount']))
        {
            $errorMSG="Voer alstublieft een correct getal in";
        }
        elseif($_POST['newAmount']<=0)
        {
            $errorMSG="Voer alstublieft een getal hoger dan 1 in";
        }
        else
        {
            foreach($_SESSION['cart'] as $key => $value)
            {
                if($value["product_id"] == $_GET['id'])
                {
                    $stock=sql("stockitemholdings", "QuantityOnHand", $_SESSION['cart'][$key]['product_id']);
                    if($_POST['newAmount']<=$stock)
                    {
                        $_SESSION['cart'][$key]['amount']=$_POST['newAmount'];
                    }
                    else
                    {
                        $errorMSG="Het door u ingevoerde getal is meer dan de huidige voorraad!" . "<br>" . "Huidige voorraad:" . $stock;
                    }
                }
            }
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

    </head>
<body class ="bg-light">


<?php
    //Creates the header
    require_once('./header.php');
?>

<div class="errorMSG">
    <?php echo $errorMSG ?>
</div>

<div class="container-fluid">
    <div class="row px5">
        <div class="col-md-7">
            <div class="shopping-cart"></div>
            <h6>Mijn winkelmandje</h6>
            <hr>
            <?php

            //Calculates the total cost and discount from the shopping cart
            $total=0;
            $totaleKorting=0;
            if(isset($_SESSION['cart']))
            {
                $product_id=array_column($_SESSION['cart'],'product_id');
                $result = $db->getData();
                while($row=mysqli_fetch_assoc(($result)))
                {
                    foreach($product_id as $id)
                    {
                        if($row['StockItemID']==$id)
                        {
                            $amountOfProduct = $_SESSION['cart'][getparent($_SESSION['cart'],$row["StockItemName"])]['amount'];
                            cartElement($row["StockItemName"],$row["UnitPrice"],"./upload/product1.png",$row["StockItemID"],$amountOfProduct,$row["RecommendedRetailPrice"]);
                            $total+=$row["UnitPrice"]*$amountOfProduct;
                            $totaleKorting+=($row["RecommendedRetailPrice"]-$row["UnitPrice"])*$amountOfProduct;
                        }
                    }
                }
            }
            else
            {
                echo "<h5>Winkelmandje is leeg</h5>";
            }
            ?>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
            <div class="pt-4">
                <h6>Kosten</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                        if(isset($_SESSION['cart']))
                        {
                            $count=getTotalItems($_SESSION['cart']);
                            if($count==1)
                            {
                                echo "<h6>Prijs ($count artikel)</h6>";
                            }
                            else
                            {
                                echo "<h6>Prijs ($count artikelen)</h6>";
                            }
                        }
                        else
                        {
                            echo "<h6>Prijs (0 artikelen)</h6>";

                        }
                        ?>
                        <h6>Totale Korting:</h6>
                        <h6>Bezorgkosten</h6>
                        <hr>
                        <h6>Totaal</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>€<?php echo $total; ?></h6>
                        <h6 class="text-success"> €<?php echo $totaleKorting ?></h6>
                        <h6 class="text-success">GRATIS</h6>
                        <hr>
                        <h6>€<?php
                            echo $total;
                            ?></h6>
                    </div>
                </div>
            </div>
            <?php
            if(getTotalItems($_SESSION['cart'])>0)
            {
                ?>
                <form action=afrekenen.php method="post">
                    <button type="submit" class="btn btn-primary" name="add">Betalen</button>
                </form>
                <?php
            }
            ?>

        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>