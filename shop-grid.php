<?php include('header.php'); ?>
<!-- Hero Section Begin -->
<?php include('header-middle.php'); ?>
<!-- Hero Section End -->
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <?php
                        require("connection/db.php");
                        $query = "SELECT * FROM `store` WHERE ID = " . $_GET['storeid'];
                        if ($result = $mysqli->query($query)) {
                            while($row = $result->fetch_array()){
                                echo '<h2>'.$row['StoreName'].'</h2>
                                <div class="breadcrumb__option">
                                    <a href="./index">Shop</a>
                                    <span>'.$row['StoreAddress'].'</span>
                                </div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Department</h4>
                        <ul>
                            <li><a href="#">Fresh Meat</a></li>
                            <li><a href="#">Vegetables</a></li>
                            <li><a href="#">Fruit & Nut Gifts</a></li>
                            <li><a href="#">Fresh Berries</a></li>
                            <li><a href="#">Ocean Foods</a></li>
                            <li><a href="#">Butter & Eggs</a></li>
                            <li><a href="#">Fastfood</a></li>
                            <li><a href="#">Fresh Onion</a></li>
                            <li><a href="#">Papayaya & Crisps</a></li>
                            <li><a href="#">Oatmeal</a></li>
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4>Price</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="10" data-max="540">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar__item sidebar__item__color--option">
                        <h4>Colors</h4>
                        <div class="sidebar__item__color sidebar__item__color--white">
                            <label for="white">
                                White
                                <input type="radio" id="white">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--gray">
                            <label for="gray">
                                Gray
                                <input type="radio" id="gray">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--red">
                            <label for="red">
                                Red
                                <input type="radio" id="red">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--black">
                            <label for="black">
                                Black
                                <input type="radio" id="black">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--blue">
                            <label for="blue">
                                Blue
                                <input type="radio" id="blue">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--green">
                            <label for="green">
                                Green
                                <input type="radio" id="green">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select>
                                    <option value="0">Default</option>
                                    <option value="0">Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <!-- <h6><span>16</span> Products found</h6> -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                        $count = 0;
                        require("connection/db.php");
                        function getImage($ProductID){
                            $dir = 'img/product/';
                            $files2 = scandir($dir, SCANDIR_SORT_ASCENDING);
                            $count = 0;
                            $GetImages = array();
                            foreach($files2 as $img){
                                $haystack = $img;
                                $needle = '_';
                                if (strpos($haystack, $needle) !== false) {
                                    $String = explode("_",$img);
                                    if($String[0] == $ProductID){
                                        array_push($GetImages,$img);
                                    }
                
                                }
                                $count++;
                            }
                            return $GetImages;
                        }
                        $query = "SELECT * FROM `products` WHERE StoreID = " . $_GET['storeid'];
                        if ($result = $mysqli->query($query)) {
                            if($result->num_rows > 0){
                                while($row = $result->fetch_array()){
                                    $ProductID = $row['ID'];
                                    $count = count(getImage($row['ID']));
                                    if($count == 0){
                                        $img = "img/product/empty.jpg";
                                    }
                                    else{
                                        $img = getImage($row['ID'])[0];
                                        $img = "img/product/".$img."?v=" . date('Ymdhis');
                                    }

                                    $Price = $row['Price'];
                                    $DiscountedPrice = $row['DiscountedPrice'];

                                    $OrigPriceText = '';
                                    $OrigPrice = 0;
                                    if($Price >= $DiscountedPrice && $DiscountedPrice > 0){
                                        $OrigPrice = $DiscountedPrice;
                                        $OrigPriceText = '<h5><span class="price-down">₱ '.$Price.'</span> ₱ '.$DiscountedPrice.'</h5>';
                                    }
                                    else{
                                        $OrigPrice = $Price;
                                        $OrigPriceText = '<h5>₱ '.$Price.'</h5>';
                                    }
                                    $cartRow = $mysqli->query("SELECT COALESCE(SUM(Quantity),0) AS Quantity FROM `cart` WHERE ProductID = $ProductID AND `Status` = 1")->fetch_array();
                                    $OrderQty = $cartRow['Quantity'];
                                    $RemQty = $row['Quantity'] - $OrderQty;

                                    echo '
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg show-link" data-setbg="'.$img.'" link="shop-details?id='.$row['ID'].'">
                                                <ul class="product__item__pic__hover">
                                                    <li><a class="btn_Wishlist" ProductID="'.$row['ID'].'"" Price="'.$OrigPrice.'" RemQty="'.$RemQty.'"><i class="fa fa-heart"></i></a></li>
                                                    <li><a class="btn_AddToCart" ProductID="'.$row['ID'].'"" Price="'.$OrigPrice.'" RemQty="'.$RemQty.'"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__item__text">
                                                <h6><a href="shop-details?id='.$row['ID'].'">'.$row['ProductName'].'</a></h6>
                                                '.$OrigPriceText.'
                                            </div>
                                        </div>
                                    </div>';
                                    $count++;
                                }
                            }
                            else{
                                echo '<h1>No Product Found</h1>';
                            }
                        }
                    ?>
                </div>
                <?php if($count > 0){ ?>
                <div class="product__pagination">
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<?php include('footer.php'); ?>
<script>
    var glob_SessionUserID = parseInt('<?=$UserID?>');
    $('body').delegate(".btn_AddToCart",'click',function(e){
        e.stopPropagation();
        if(glob_SessionUserID == 0){
            window.location = 'login-register';
            return;
        }
        var ProductID = $(this).attr('ProductID');
        var Price = $(this).attr('Price');
        var RemQty = $(this).attr('RemQty');
        var Quantity = 1;
        var TotalPrice = Quantity * parseFloat(Price);
        if(RemQty == 0){
            Message(1,'This product is already sold out');
            return;
        }
        var data = {
            ProductID : ProductID,
            Price : Price,
            Quantity : Quantity,
            TotalPrice : TotalPrice,
        }
        CallAjax(data,1,'addtocart');
    });
    $('body').delegate(".btn_Wishlist",'click',function(e){
        e.stopPropagation();
        if(glob_SessionUserID == 0){
            window.location = 'login-register';
            return;
        }
        var ProductID = $(this).attr('ProductID');
        var Price = $(this).attr('Price');
        var RemQty = $(this).attr('RemQty');
        var Quantity = 1;
        var TotalPrice = Quantity * parseFloat(Price);
        if(RemQty == 0){
            Message(1,'This product is already sold out');
            return;
        }
        var data = {
            ProductID : ProductID,
            Price : Price,
            Quantity : Quantity,
            TotalPrice : TotalPrice,
        }
        CallAjax(data,2,'wishlist');
    });
    $('body').delegate(".show-link",'click',function(e){
        e.preventDefault();
        var link = $(this).attr('link');
        window.location = link;
    });
    function CallAjax(data,route,action){
        $.ajax({
            type: 'POST',
            url: 'ajax_url.php?action='+action,
            data: data,
            dataType:'json',
            beforeSend: function(){},
            complete: function(){},
            success: function(evt){
                switch(route){
                    case 1:
                        if(parseInt(evt['Result']) == 1){
                            Message(2,'Successfully added to cart');
                        }
                        else if (parseInt(evt['Result']) == 0){
                            Message(1,'Error spotted');
                        }
                        else{
                            Message(1,'Please update your address to proceed');
                        }
                    break;
                    case 2:
                        Message(2,'Successfully added to wishlist');
                    break;
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('error: ' + textStatus + ': ' + errorThrown);
            }
        });
    }
</script>