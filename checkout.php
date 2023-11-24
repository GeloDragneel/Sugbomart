    <?php include('header.php'); ?>
    <?php
        $count = 0;
        $FirstName = '';
        $LastName = '';
        $Address = '';
        require("connection/db.php");
        $query = "SELECT * FROM `user` WHERE ID = 8" ;
        if ($result = $mysqli->query($query)) {
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $FirstName = $row['FirstName'];
                    $LastName = $row['LastName'];
                    $Address = $row['Address'];
                }
            }
            else{echo '<tr><td colspan="5">No Cart Yet</td></tr>';}
        }
        $cntItem = 0;
        $query = "SELECT COUNT(*) as cntItem FROM cart A WHERE A.UserID = 8 AND A.Status = 0" ;
        if ($result = $mysqli->query($query)) {
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $cntItem = $row['cntItem'];
                }
            }
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
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="index">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <?php if($cntItem > 0){ ?>
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" value="<?=$FirstName?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" value="<?=$LastName?>">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" value="<?=$Address?>">
                                <input type="text" placeholder="Apartment, suite, unite ect (optinal)">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul id="ul_List">
                                    <?php
                                        $count = 0;
                                        $SubTotal = 0;
                                        require("connection/db.php");
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
                                                    echo '<li CartID="'.$row['ID'].'">'.$row['ProductName'].' <span>₱'.$row['TotalPrice'].'</span></li>';
                                                    $SubTotal += $row['TotalPrice'];
                                                }
                                            }
                                            else{echo '<tr><td colspan="5">No Cart Yet</td></tr>';}
                                        }
                                    ?>
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>₱<?=number_format($SubTotal,2)?></span></div>
                                <div class="checkout__order__total">Total <span>₱<?=number_format($SubTotal,2)?></span></div>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Cash on Delivery (COD)
                                        <input type="radio" id="payment" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="button" id="btn_Place_Order" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    <?php } else{  ?>
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Thank Your for choosing us</h4>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php include('footer.php'); ?>
    <script>
        $("#btn_Place_Order").on("click",function(){
            var list = $("#ul_List").find("li"), newArray = [];
            list.each(function(){
                newArray.push({
                    CartID : $(this).attr('CartID')
                });
            });
            CallAjax({newArray},1,'place_order');
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
                            Message(2,'Successfully Placed Order');
                            setTimeout(function() { 
                                location.reload();
                            }, 600);
                        break;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('error: ' + textStatus + ': ' + errorThrown);
                }
            });
        }
    </script>