    <?php include('header.php'); ?>
    <style>
        .owl-carousel .owl-stage {
            display: flex;
        }
        .owl-carousel .owl-item img {
            width: auto !important;
            height: 100%;
        }
        .owl-carousel.owl-drag .owl-item{
            width: 100% !important
        }
    </style>
    <?php 
        require("connection/db.php");
        $Price = 0;
        $DiscountedPrice = 0;
        $ExpiryDate = 0;
        $RemQty = 0;
        $StoreID = 0;
        $ProductName = '';
        $ProductDesc = '';
        $ProductInfo = '';
        $Unit = '';
        $Availability = '';
        $CategoryName = '';
        $ProductID = $_GET['id'];
        $query = "
        SELECT 
            A.ID,
            A.ProductName,
            A.CategoryID,
            A.ProductDesc,
            A.ProductInfo,
            A.Price,
            A.DiscountedPrice,
            A.Quantity,
            A.StoreID,
            A.ExpiryDate,
            A.Unit,
            B.CategoryName 
        FROM `products` A 
        LEFT JOIN category B ON B.ID = A.CategoryID 
        WHERE A.ID = " .$ProductID;
        if ($result = $mysqli->query($query)) {
            while($row = $result->fetch_array()){

                $cartRow = $mysqli->query("SELECT COALESCE(SUM(Quantity),0) AS Quantity FROM `cart` WHERE ProductID = $ProductID AND `Status` = 1")->fetch_array();
                $OrderQty = $cartRow['Quantity'];

                $ProductName = $row['ProductName'];
                $Price = $row['Price'];
                $ExpiryDate = $row['ExpiryDate'];
                $DiscountedPrice = $row['DiscountedPrice'];
                $ProductDesc = $row['ProductDesc'];
                $ProductInfo = $row['ProductInfo'];
                $CategoryName = $row['CategoryName'];
                $Unit = $row['Unit'];
                $StoreID = $row['StoreID'];
                $RemQty = $row['Quantity'] - $OrderQty;
                $Availability = ($RemQty > 0 ? 'In Stock' : 'Sold Out');

                $OrigPrice = 0;
                if($Price >= $DiscountedPrice && $DiscountedPrice > 0){
                    $OrigPrice = $DiscountedPrice;
                }
                else{
                    $OrigPrice = $Price;
                }

                $mysqldate = $row['ExpiryDate'];
                $phpdate = strtotime( $mysqldate );
                $mysqldate = date( 'M d Y', $phpdate );

                $date1 = new DateTime();
                $date2 = new DateTime($row['ExpiryDate']);
                $ExpiryDate  = $date2->diff($date1)->format('%a');

            }
        }
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
        $Thumbnail = getImage($_GET['id']);
        $count = count(getImage($_GET['id']));
        if($count == 0){
            $Thumbnail = "img/product/empty.jpg";
        }
        else{
            $Thumbnail = getImage($_GET['id'])[0];
            $Thumbnail = "img/product/".$Thumbnail."?v=" . date('Ymdhis');
        }
    ?>
    <!-- Hero Section Begin -->
    <?php include('header-middle.php'); ?>
    <!-- Hero Section End -->
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shop Details</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="<?=$Thumbnail?>" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <?php
                                $dir = 'img/product/';
                                $files2 = scandir($dir, SCANDIR_SORT_ASCENDING);
                                $count = 0;
                                $GetImages = array();
                                foreach($files2 as $img){
                                    $haystack = $img;
                                    $needle = '_';
                                    if (strpos($haystack, $needle) !== false) {
                                        $String = explode("_",$img);
                                        if($String[0] == $_GET['id']){
                                            $img = 'img/product/' . $img;
                                            echo '<img data-imgbigurl="'.$img.'" src="'.$img.'" alt="">';
                                        }
                                    }
                                    $count++;
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?=$ProductName?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <?php if($Price >= $DiscountedPrice && $DiscountedPrice > 0){ ?>
                        <div class="product__details__price price-down">₱<?=$Price?></div>
                        <div class="product__details__price">₱<?=$DiscountedPrice?></div>
                        <?php } else {?>
                        <div class="product__details__price">₱<?=$Price?></div>
                        <?php } ?>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1" class="inQuantity">
                                </div>
                            </div>
                        </div>
                        <a class="primary-btn hand-cursor <?php if($RemQty > 0){echo 'btn_AddToCart';}else{echo 'btn-disabled';}?>" ProductID="<?=$_GET['id']?>" RemQty="<?=$RemQty?>" Price="<?=$OrigPrice?>">ADD TO BASKET</a>
                        <a class="heart-icon hand-cursor btn_Wishlist" ProductID="<?=$_GET['id']?>" RemQty="<?=$RemQty?>" Price="<?=$OrigPrice?>"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>CategoryName</b> <span> <?=$CategoryName?></span></li>
                            <li><b>Availability</b> <span> <?=$Availability?></span></li>
                            <li><b>Remaining</b> <span> <?=$RemQty?></span></li>
                            <li><b>Per</b> <span><?=$Unit?></span></li>
                            <li><b>Expiry Date</b> <span><?=$mysqldate?> <samp>expire after <?=$ExpiryDate?> days</samp></span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Description</h6>
                                    <p><?=$ProductDesc?></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p><?=$ProductInfo?></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Review</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title">
                                    <h2>More from this shop</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row featured__filter">
                        <?php
                            require("connection/db.php");
                            $query = "SELECT * FROM `products` WHERE ID NOT IN($ProductID) AND StoreID = $StoreID ORDER BY RAND() LIMIT 4";
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
                                        <div class="col-lg-3 col-md-6 col-sm-6">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->
    <?php include('footer.php'); ?>
    <script>
        var glob_SessionUserID = parseInt('<?=$UserID?>');
        $('body').delegate(".btn_AddToCart",'click',function(e){
            if(glob_SessionUserID == 0){
                window.location = 'login-register';
                return;
            }
            var ProductID = $(this).attr('ProductID');
            var Price = $(this).attr('Price');
            var RemQty = $(this).attr('RemQty');
            var Quantity = $(".inQuantity").val();
            var TotalPrice = Quantity * parseFloat(Price);

            if(Quantity > RemQty){
                Message(1,'Insufficient pcs or kg');
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
            if(glob_SessionUserID == 0){
                window.location = 'login-register';
                return;
            }
            var ProductID = $(this).attr('ProductID');
            var Price = $(this).attr('Price');
            var RemQty = $(this).attr('RemQty');
            var Quantity = $(".inQuantity").val();
            var TotalPrice = Quantity * parseFloat(Price);

            if(Quantity > RemQty){
                Message(1,'Insufficient pcs or kg');
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
                            Message(2,'Successfully added to cart');
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