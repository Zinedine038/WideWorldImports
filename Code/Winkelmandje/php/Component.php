<?php

//Callable component for a shopping item with the assigned values for the item
function component($productname, $productprice, $productimg, $productDescription, $productID, $reccomendedPrice = 699)
{
    //Photo behaviour
    $fotoPath = $productimg;
    $productPageLink = "http://localhost/wideworldimports/code/productpage.php?stockitemid=" . $productID;
    $currentLink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    //Uses default photo if he can't find a photo
    if(sqlfoto($productID)[0]!=null)
    {
        $fotoPath = sqlfoto($productID)[0];
    }
    //HTML
    $element = "            
            <div class=\"col-md-3 col-sm-6 my-3\">
                <form action=$currentLink method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <a href=$productPageLink>
                                <img src=\"$fotoPath\" alt=\"Image1\" class = \"img-fluid card-img-top plaatjescomponent\">
                            </a>
                        </div>
                        <div class=\"card-body\">
                            <a href=$productPageLink>
                                <h5 class=\"card-title\">$productname</h5>
                            </a>
                            <h6>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"far fa-star\"></i>
                            </h6>
                            <p class=\"card-text\" style='text-decoration: unset; width: unset; color: unset;'>
                                $productDescription
                            </p>
                            <h5>
                                <small><s class=\"text-secondary\">€$reccomendedPrice</s></small>
                                <span class=\"price\">€$productprice
                            </span>
                            </h5>
                            <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Voeg toe aan Winkelmandje<i class=\"fas fa-shopping-cart\"></i></button>
                            <input type='hidden' name='product_id' value='$productID'>
                            <input type='hidden' name='product_name' value='$productname'>
                        </div>
                    </div>
                </form>
        </div>"
                ;
    echo $element;
}

//Component but specificly for the shopping cart with a different layout and some other values
function cartElement($productname, $productprice, $productimg, $productID, $amount, $reccomendedPrice = 699)
{
    include_once 'functions.php';
    //Photo behaviour
    $productPageLink = "http://localhost/wideworldimports/code/productpage.php?stockitemid=" . $productID;
    $foto = $productimg;
    //Uses default photo if he can't find a photo
    if(sqlfoto($productID)[0]!=null)
    {
        $foto = sqlfoto($productID)[0];
    }
    //HTML
    $element="
                <form action=\"cart.php?action=remove&id=$productID\"  method=\"post\" class=\"cart-items\">
                <div class=\"border rounded\">
                    <div class=\"row bg-white\">
                        <div class=\"col md-3 pl-0\">
                            <a href=$productPageLink>
                                <img src=$foto alt=$foto class=\"img-fluid\">
                            </a>
                        </div>
                        <div class=\"col md-6\">
                            <a href=$productPageLink>
                                <h5 class=\"pt-2\">$productname</h5>
                            </a>
                            <small class=\"text-secondary\">Verkoper: WWI</small><br>
                            <small><s class=\"col-md-3\">€$reccomendedPrice</s></small>
                            <h5 class=\"col-md-3\">€$productprice</h5>
                            <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Verwijderen</button>
                            </form>
                        </div>
                        <div class=\"col md-3 py-5\">
                        <div>
                        <form action=\"cart.php?action=addOne&id=$productID\" method=\"post\" class=\"cart-items\">
                             <button type=\"submit\" class=\"btn bg-light border rounded-circle\" name=\"addOne\"><i class=\"fas fa-plus\"></i></button>
                        </form> 
                        <form action=\"cart.php?action=changeAmount&id=$productID\" method=\"post\" class=\"cart-items\">
                             <input type=\"text\" value=$amount name=\"newAmount\" class=\"form-control w-25 d-inline\">
                        </form>
                        <form action=\"cart.php?action=removeOne&id=$productID\" method=\"post\" class=\"cart-items\">
                             <button type=\"submit\" class=\"btn bg-light border rounded-circle\" name=\"removeOne\"><i class=\"fas fa-minus\"></i></button>
                        </form>
                        </div>
                        </div>
                    </div>
                </div>

    
    ";
        echo $element;
}


?>