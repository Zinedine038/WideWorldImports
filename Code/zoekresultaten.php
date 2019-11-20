<?php
//start session
session_start();

if(isset($_POST['add']))
{
    //print_r($_POST['product_id']);
    if(isset($_SESSION['cart']))
    {
        $item_array_id = array_column($_SESSION['cart'],"product_id");

        if(in_array(($_POST['product_id']), $item_array_id))
        {
            echo "<script>alert('product is already added to your cart')</script>";
            echo "<script>window.location = 'zoekresultaten.php</script>";
        }
        else
        {
            $count=count($_SESSION['cart']);
            $item_array=array('product_id' => $_POST['product_id']);
            $_SESSION['cart'][$count]=$item_array;
        }
    } else
    {
        $item_array=array('product_id' => $_POST['product_id']);
        //Create new session variable
        $_SESSION['cart'][0] = $item_array;
    }
}

require_once('header.php');
require_once("winkelmandje/php/component.php");

?>







<div class="container">
    <div class="row text-center py-5">
        <?php
        $zoekterm=$_GET["zoekterm"];
        $result = search($zoekterm);
        foreach ($result AS $id) {
            $naam = sql("stockitems", "stockitemname", $id);
            $prijs = sql("stockitems", "RecommendedRetailPrice", $id);
            $commentaar = sql("stockitems", "MarketingComments", $id);
            $Itemid = sql("stockitems", "StockItemID", $id);
            component($naam,$prijs,"./upload/product1.png",$commentaar,$Itemid);
        }

        ?>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>