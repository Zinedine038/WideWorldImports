<?php
session_start();

$count = 0;
$i = 0;

include_once("functions.php");
updateShoppingCart();

include 'header.php';
include 'Winkelmandje/php/Component.php';
include_once '../config.php';
?>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <?php component("naam",400, "https://scontent-lax3-1.cdninstagram.com/v/t51.2885-15/e35/s240x240/18252998_648320338708577_4740932540825600000_n.jpg?_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_cat=105&oh=067a2119d47ef7a69267426506be8600&oe=5E198471&ig_cache_key=MTUwNzU4Mjk5OTQ3MzkxNzEyOQ%3D%3D.2","thicc",69 ) ?>
                    <?php component("naam",400, "https://scontent-lax3-1.cdninstagram.com/v/t51.2885-15/e35/s240x240/18252998_648320338708577_4740932540825600000_n.jpg?_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_cat=105&oh=067a2119d47ef7a69267426506be8600&oe=5E198471&ig_cache_key=MTUwNzU4Mjk5OTQ3MzkxNzEyOQ%3D%3D.2","thicc",69 ) ?>
                    <?php component("naam",400, "https://scontent-lax3-1.cdninstagram.com/v/t51.2885-15/e35/s240x240/18252998_648320338708577_4740932540825600000_n.jpg?_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_cat=105&oh=067a2119d47ef7a69267426506be8600&oe=5E198471&ig_cache_key=MTUwNzU4Mjk5OTQ3MzkxNzEyOQ%3D%3D.2","thicc",69 ) ?>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <?php component("naam",400, "https://scontent-lax3-1.cdninstagram.com/v/t51.2885-15/e35/s240x240/18252998_648320338708577_4740932540825600000_n.jpg?_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_cat=105&oh=067a2119d47ef7a69267426506be8600&oe=5E198471&ig_cache_key=MTUwNzU4Mjk5OTQ3MzkxNzEyOQ%3D%3D.2","thicc",69 ) ?>
                    <?php component("naam",400, "https://scontent-lax3-1.cdninstagram.com/v/t51.2885-15/e35/s240x240/18252998_648320338708577_4740932540825600000_n.jpg?_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_cat=105&oh=067a2119d47ef7a69267426506be8600&oe=5E198471&ig_cache_key=MTUwNzU4Mjk5OTQ3MzkxNzEyOQ%3D%3D.2","thicc",69 ) ?>
                    <?php component("naam",400, "https://scontent-lax3-1.cdninstagram.com/v/t51.2885-15/e35/s240x240/18252998_648320338708577_4740932540825600000_n.jpg?_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_cat=105&oh=067a2119d47ef7a69267426506be8600&oe=5E198471&ig_cache_key=MTUwNzU4Mjk5OTQ3MzkxNzEyOQ%3D%3D.2","thicc",69 ) ?>                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <?php component("naam",400, "https://scontent-lax3-1.cdninstagram.com/v/t51.2885-15/e35/s240x240/18252998_648320338708577_4740932540825600000_n.jpg?_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_cat=105&oh=067a2119d47ef7a69267426506be8600&oe=5E198471&ig_cache_key=MTUwNzU4Mjk5OTQ3MzkxNzEyOQ%3D%3D.2","thicc",69 ) ?>
                    <?php component("naam",400, "https://scontent-lax3-1.cdninstagram.com/v/t51.2885-15/e35/s240x240/18252998_648320338708577_4740932540825600000_n.jpg?_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_cat=105&oh=067a2119d47ef7a69267426506be8600&oe=5E198471&ig_cache_key=MTUwNzU4Mjk5OTQ3MzkxNzEyOQ%3D%3D.2","thicc",69 ) ?>
                    <?php component("naam",400, "https://scontent-lax3-1.cdninstagram.com/v/t51.2885-15/e35/s240x240/18252998_648320338708577_4740932540825600000_n.jpg?_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_cat=105&oh=067a2119d47ef7a69267426506be8600&oe=5E198471&ig_cache_key=MTUwNzU4Mjk5OTQ3MzkxNzEyOQ%3D%3D.2","thicc",69 ) ?>                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<?php






include 'paginanummer.php';

include 'footer.php'; ?>