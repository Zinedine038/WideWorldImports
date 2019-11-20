<?php

function component($productname, $productprice, $productimg, $productDescription, $productID)
{
    $fotoPath = $productimg;
    if(sqlfoto($productID)[0]!=null)
    {
        $fotoPath = sqlfoto($productID)[0];
    }
    $element = "            
            <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                <form action=\"index.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img src=\"$fotoPath\" alt=\"Image1\" class = \"img-fluid card-img-top\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productname</h5>
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
                                <small><s class=\"text-secondary\">$699</s></small>
                                <span class=\"price\">$$productprice
                            </span>
                            </h5>
                            <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Voeg toe aan Winkelmandje<i class=\"fas fa-shopping-cart\"></i></button>
                            <input type='hidden' name='product_id' value='$productID'>
                        </div>
                    </div>
                </form>
        </div>"
                ;
    echo $element;
}


function cartElement($productname, $productprice, $productimg, $productID)
{
    include_once "functions.php";
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
                            <img src=$foto alt=$foto class=\"img-fluid\">
                        </div>
                        <div class=\"col md-6\">
                            <h5 class=\"pt-2\">$productname</h5>
                            <small class=\"text-secondary\">Verkoper: WWI</small>
                            <h5 class=\"col-md-3\">€$productprice</h5>
                            <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                            <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                        </div>
                        <div class=\"col md-3 py-5\">
                        <div>
                            <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                            <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                            <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>

    
    ";
        echo $element;
}


?>