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
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="index">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tbody_Cart">
                                <?php
                                    $count = 0;
                                    $SubTotal = 0;
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

                                    $query = "
                                    SELECT 
                                        A.ID,
                                        B.ID AS ProductID,
                                        B.ProductName,
                                        A.Price,
                                        A.Quantity AS Qty,
                                        A.TotalPrice AS TotalPrice
                                    FROM cart A
                                    INNER JOIN products B ON B.ID = A.ProductID
                                    WHERE A.UserID = $UserID
                                    AND A.Status = 0" ;
                                    if ($result = $mysqli->query($query)) {
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_array()){
                                                $count = count(getImage($row['ID']));
                                                if($count == 0){
                                                    $Img = "img/product/empty.jpg";
                                                }
                                                else{
                                                    $Img = getImage($row['ID'])[0];
                                                    $Img = "img/product/".$Img."?v=" . date('Ymdhis');
                                                }
                                                echo '
                                                <tr CartID="'.$row['ID'].'" Price="'.$row['Price'].'" TotalPrice="'.$row['TotalPrice'].'">
                                                    <td class="shoping__cart__item">
                                                        <img src="'.$Img.'" alt="'.$row['ProductName'].'" style="height: 100px;">
                                                        <h5>'.$row['ProductName'].'</h5>
                                                    </td>
                                                    <td class="shoping__cart__price">₱'.$row['Price'].'</td>
                                                    <td class="shoping__cart__quantity">
                                                        <div class="quantity">
                                                            <div class="pro-qty">
                                                                <input type="text" class="in_Quantity" value="'.$row['Qty'].'" min="1">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="shoping__cart__total">₱'.$row['TotalPrice'].'</td>
                                                    <td class="shoping__cart__item__close"><span class="icon_close btn_Remove_Cart"></span></td>
                                                </tr>';
                                                $SubTotal += $row['TotalPrice'];
                                            }
                                        }
                                        else{echo '<tr><td colspan="5">No Cart Yet</td></tr>';}
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="index" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a class="primary-btn cart-btn cart-btn-right hand-cursor" hidden id="btn_Update_Cart"><span class="icon_loading"></span>Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>₱<span id="span_SubTotal"><?=number_format($SubTotal,2)?></span></span></li>
                            <li>Total <span>₱<span id="span_Total"><?=number_format($SubTotal,2)?></span></span></li>
                        </ul>
                        <a class="primary-btn hand-cursor" id="btn_Proceed_Checkout">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
    <?php include('footer.php'); ?>
    <script>
        $("#tbody_Cart").on("click",".inc",function(){
            var ClosestTr = $(this).closest('tr');
            var Quantity = ClosestTr.find('td').eq(2).find('input').val();
            var TotalPrice = ClosestTr.attr('Price');
            var NewTotalPrice = parseInt(Quantity) * parseFloat(TotalPrice);
            var NewTotalPrice = NewTotalPrice.toFixed(2);
            ClosestTr.attr('TotalPrice',NewTotalPrice);
            ClosestTr.find('td').eq(3).html('₱'+NewTotalPrice);
            TotalFooter();
        });
        $("#tbody_Cart").on("click",".dec",function(){
            var ClosestTr = $(this).closest('tr');
            var Quantity = ClosestTr.find('td').eq(2).find('input').val();
            if(parseInt(Quantity) == 0){
                ClosestTr.find('td').eq(2).find('input').val(1);
                Quantity = 1;
            }
            var TotalPrice = ClosestTr.attr('Price');
            var NewTotalPrice = parseInt(Quantity) * parseFloat(TotalPrice);
            var NewTotalPrice = NewTotalPrice.toFixed(2);
            ClosestTr.attr('TotalPrice',NewTotalPrice);
            ClosestTr.find('td').eq(3).html('₱'+NewTotalPrice);
            TotalFooter();
        });
        $("#tbody_Cart").on("input",".in_Quantity",function(){
            var ClosestTr = $(this).closest('tr');
            var Quantity = ClosestTr.find('td').eq(2).find('input').val();
            var TotalPrice = ClosestTr.attr('Price');
            var NewTotalPrice = parseInt(Quantity) * parseFloat(TotalPrice);
            var NewTotalPrice = NewTotalPrice.toFixed(2);
            ClosestTr.attr('TotalPrice',NewTotalPrice);
            ClosestTr.find('td').eq(3).html('₱'+NewTotalPrice);
            TotalFooter();
        });
        $("#btn_Update_Cart").on("click",function(){
            var $row = $("#tbody_Cart").find('tr'), newArray = [];
            $row.each(function(){
                var CartID = $(this).attr('CartID');
                var TotalPrice = $(this).attr('TotalPrice');
                var Quantity = $(this).find('td').eq(2).find('input').val();
                newArray.push({
                    CartID : CartID,
                    TotalPrice : TotalPrice,
                    Quantity : Quantity,
                });
            });
            CallAjax({newArray},1,'update_cart');
        });
        $("#tbody_Cart").on("click",".btn_Remove_Cart",function(){
            var ClosestTr = $(this).closest('tr');
            var CartID = ClosestTr.attr("CartID");
            ClosestTr.remove();
            CallAjax({CartID : CartID},2,'delete_cart');
        });
        $("#btn_Proceed_Checkout").on("click",function(){
            var $row = $("#tbody_Cart").find('tr'), newArray = [];
            $row.each(function(){
                var CartID = $(this).attr('CartID');
                newArray.push({
                    CartID : CartID,
                });
            });
            CallAjax({newArray},3,'proceed_cart');
        });
        function TotalFooter(){
            var $row = $("#tbody_Cart").find("tr"), SubTotal = 0;
            $row.each(function(){
                SubTotal += parseFloat($(this).attr('TotalPrice'));
            });
            $("#btn_Update_Cart").click();
            $("#span_Total").text(MoneyFormat(parseFloat(SubTotal).toFixed(2)));
            $("#span_SubTotal").text(MoneyFormat(parseFloat(SubTotal).toFixed(2)));
        }
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
                        case 1: console.log('Cart Updated');break;
                        case 2:
                            Message(2,'Cart successfully remove');
                            setTimeout(function() { 
                                TotalFooter();
                            }, 600);
                        break;
                        case 3:window.location = "checkout";break;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('error: ' + textStatus + ': ' + errorThrown);
                }
            });
        }
    </script>