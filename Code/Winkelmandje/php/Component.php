<?php

function component($productname, $productprice, $productimg, $productDescription, $productID)
{
    $fotoPath = $productimg;
    $productPageLink = "http://localhost/wideworldimports/code/productpage.php?stockitemid=" . $productID;
    $currentLink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(sqlfoto($productID)[0]!=null)
    {
        $fotoPath = sqlfoto($productID)[0];
    }
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
                                <small><s class=\"text-secondary\">€699</s></small>
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


function cartElement($productname, $productprice, $productimg, $productID, $amount)
{
    include_once 'functions.php';
    $productPageLink = "http://localhost/wideworldimports/code/productpage.php?stockitemid=" . $productID;
    $foto = $productimg;
    if(sqlfoto($productID)[0]!=null)
    {
        $foto = sqlfoto($productID)[0];
    }
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
                            <small class=\"text-secondary\">Verkoper: WWI</small>
                            <h5 class=\"col-md-3\">€$productprice</h5>
                            <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Verwijderen</button>
                        </div>
                        <div class=\"col md-3 py-5\">
                        <div>
                            <button type=\"submit\" class=\"btn bg-light border rounded-circle\" name=\"removeOne\"><i class=\"fas fa-minus\"></i></button>
                            <input type=\"text\" value=$amount class=\"form-control w-25 d-inline\">
                            <button type=\"submit\" class=\"btn bg-light border rounded-circle\" name=\"addOne\"><i class=\"fas fa-plus\"></i></button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>

    
    ";
        echo $element;
}


?>