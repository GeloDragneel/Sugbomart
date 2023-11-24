<?php include('header.php'); ?>
    <style>
        .tabset > input[type="radio"] {
            position: absolute;
            left: -200vw;
        }

        .tabset .tab-panel {
            display: none;
        }
        .tabset > input:first-child:checked ~ .tab-panels > .tab-panel:first-child,
        .tabset > input:nth-child(3):checked ~ .tab-panels > .tab-panel:nth-child(2),
        .tabset > input:nth-child(5):checked ~ .tab-panels > .tab-panel:nth-child(3),
        .tabset > input:nth-child(7):checked ~ .tab-panels > .tab-panel:nth-child(4),
        .tabset > input:nth-child(9):checked ~ .tab-panels > .tab-panel:nth-child(5),
        .tabset > input:nth-child(11):checked ~ .tab-panels > .tab-panel:nth-child(6) {
            display: block;
        }
        .tabset > label {
            position: relative;
            display: inline-block;
            padding: 15px 15px 25px;
            border: 1px solid transparent;
            border-bottom: 0;
            cursor: pointer;
            font-weight: 600;
        }
        .tabset > label::after {
            content: "";
            position: absolute;
            left: 15px;
            bottom: 10px;
            width: 75%;
            height: 4px;
            background: #8d8d8d;
        }
        input:focus-visible + label {
            outline: 2px solid rgba(0,102,204,1);
            border-radius: 3px;
        }
        .tabset > label:hover,
        .tabset > input:focus + label,
        .tabset > input:checked + label {
            color: #7fad39;
        }
        .tabset > label:hover::after,
        .tabset > input:focus + label::after,
        .tabset > input:checked + label::after {
            background: #7fad39;
        }
        .tabset > input:checked + label {
            border-color: #ccc;
            border-bottom: 1px solid #fff;
            margin-bottom: -1px;
        }
        .tab-panel {
            padding: 30px 0;
            border-top: 1px solid #ccc;
        }
        .tabset {
            max-width: 65em;
        }
    </style>
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
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
                            <li><a href="#">Fresh Bananas</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Register</h2>
                        <div class="breadcrumb__option">
                            <a href="#">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="contact-form spad">
        <div class="container">
            <div class="tabset text-center">
                <!-- Tab 1 -->
                <input type="radio" name="tabset" id="tab1" aria-controls="Customer" checked>
                <label for="tab1">Register as Customer</label>
                <!-- Tab 2 -->
                <input type="radio" name="tabset" id="tab2" aria-controls="Vendor">
                <label for="tab2">Register as Vendor</label>
                <div class="tab-panels">
                    <section id="Customer" class="tab-panel">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="contact__form__title text-left">
                                    <h2>Register as Customer</h2>
                                </div>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>Email</label>
                                            <input type="text" id="reg_Email">
                                        </div>
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>Password</label>
                                            <input type="password" id="reg_Password">
                                        </div>
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>First Name</label>
                                            <input type="text" id="reg_FirstName">
                                        </div>
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>Last Name</label>
                                            <input type="text" id="reg_LastName">
                                        </div>
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>Phone Number</label>
                                            <input type="text" id="reg_PhoneNumber">
                                        </div>
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>&nbsp;</label>
                                            <input type="button" class="site-btn" id="btn_Register" value="Register" style="color: #fff;">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </section>
                    <section id="Vendor" class="tab-panel">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="contact__form__title text-left">
                                    <h2>Register as Vendor</h2>
                                </div>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>Email</label>
                                            <input type="text" id="reg_Email2">
                                        </div>
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>Password</label>
                                            <input type="password" id="reg_Password2">
                                        </div>
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>First Name</label>
                                            <input type="text" id="reg_FirstName2">
                                        </div>
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>Last Name</label>
                                            <input type="text" id="reg_LastName2">
                                        </div>
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>Phone Number</label>
                                            <input type="text" id="reg_PhoneNumber2">
                                        </div>
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>Shop Name</label>
                                            <input type="text" id="reg_ShopName2">
                                        </div>
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>Business Permit</label>
                                            <input type="text" id="reg_Business_Permit2">
                                        </div>
                                        <div class="col-lg-6 col-md-6 text-left">
                                            <label>&nbsp;</label>
                                            <input type="button" class="site-btn" id="btn_Register2" value="Register" style="color: #fff;">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </section>
                </div>
            </div>

        </div>
    </div>
    <?php include('footer.php'); ?>
    <script>
        $("#btn_Register").on("click",function(){
            Register(1,null);
        });
        $("#btn_Register2").on("click",function(){
            Register(2,null);
        });
        function Register(route,data){
            switch(route){
                case 1:
                    var Email = $("#reg_Email").val();
                    var Password = $("#reg_Password").val();
                    var FirstName = $("#reg_FirstName").val();
                    var LastName = $("#reg_LastName").val();
                    var ShopName = '';
                    var BusinessPermit = '';
                    var PhoneNumber = $("#reg_PhoneNumber").val();
                    var UserType = 1;
                    var Status = 1;
                    if(Email == ''){
                        Message(1,'Email is required');
                        return;
                    }
                    if (!isEmail(Email)) {
                        Message(1,'Email is invalid');
                        return;     
                    }
                    if(Password == ''){
                        Message(1,'Password is required');
                        return;
                    }
                    if(FirstName == ''){
                        Message(1,'FirstName is required');
                        return;
                    }
                    if(LastName == ''){
                        Message(1,'LastName is required');
                        return;
                    }
                    if(PhoneNumber == ''){
                        Message(1,'PhoneNumber is required');
                        return;
                    }
                    var data = {
                        FirstName : FirstName,
                        LastName : LastName,
                        ShopName : ShopName,
                        BusinessPermit : BusinessPermit,
                        PhoneNumber : PhoneNumber,
                        Email : Email,
                        Password : Password,
                        Status : Status,
                        UserType : UserType
                    };
                    $("#btn_Register").attr('disabled',true);
                    $("#btn_Register2").attr('disabled',true);
                    CallAjax(data,1,'register');
                break;
                case 2:
                    var Email = $("#reg_Email2").val();
                    var Password = $("#reg_Password2").val();
                    var FirstName = $("#reg_FirstName2").val();
                    var LastName = $("#reg_LastName2").val();
                    var ShopName = $("#reg_ShopName2").val();
                    var BusinessPermit = $("#reg_Business_Permit2").val();
                    var PhoneNumber = $("#reg_PhoneNumber2").val();
                    var UserType = 2;
                    var Status = 0;
                    if(Email == ''){
                        Message(1,'Email is required');
                        return;
                    }
                    if (!isEmail(Email)) {
                        Message(1,'Email is invalid');
                        return;     
                    }
                    if(Password == ''){
                        Message(1,'Password is required');
                        return;
                    }
                    if(FirstName == ''){
                        Message(1,'FirstName is required');
                        return;
                    }
                    if(LastName == ''){
                        Message(1,'LastName is required');
                        return;
                    }
                    if(PhoneNumber == ''){
                        Message(1,'PhoneNumber is required');
                        return;
                    }
                    var data = {
                        FirstName : FirstName,
                        LastName : LastName,
                        ShopName : ShopName,
                        BusinessPermit : BusinessPermit,
                        PhoneNumber : PhoneNumber,
                        Email : Email,
                        Password : Password,
                        Status : Status,
                        UserType : UserType
                    };
                    $("#btn_Register").attr('disabled',true);
                    $("#btn_Register2").attr('disabled',true);
                    CallAjax(data,1,'register');
                break;
                case 3:
                    if(data['Result'] == 1){
                        $("#FirstName").val("");
                        $("#LastName").val("");
                        $("#ShopName").val("");
                        $("#BusinessPermit").val("");
                        $("#PhoneNumber").val("");
                        $("#Email").val("");
                        $("#Password").val("");
                        CallAjaxSendCode(data,1);
                    }
                break;
                case 4:
                    if(data['Result'] == "Success"){
                        // Message(2,'Registration successfully submitted');
                        window.location = 'verification_code?email=' + data['Email'];
                    }
                    else{
                        Message(1,'Error');
                        $("#btn_Register").attr('disabled',false);
                        $("#btn_Register2").attr('disabled',false);
                    }
                break;
            }
        }
        function isEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test( $email );
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
                        case 1:Register(3,evt);break;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('error: ' + textStatus + ': ' + errorThrown);
                }
            });
        }
        function CallAjaxSendCode(data,route){
            $.ajax({
                type: 'POST',
                url: 'mail_send.php',
                data: data,
                dataType:'json',
                beforeSend: function(){},
                complete: function(){},
                success: function(evt){
                    switch(route){
                        case 1:Register(4,evt);break;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('error: ' + textStatus + ': ' + errorThrown);
                }
            });
        }
    </script>