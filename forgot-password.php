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
                        <h2>Forgot Password</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="contact__form__title text-left">
                        <h2>Forgot Password</h2>
                    </div>
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 text-left">
                                <label>Email</label>
                                <input type="text" id="Email">
                            </div>
                            <div class="col-lg-12 text-left">
                                <button type="button" class="site-btn" id="btn_Forgot_Password">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script>
        $("#btn_Forgot_Password").on("click",function(){
            var data = {
                Email : $("#Email").val(),
            };
            $("#btn_Forgot_Password").text('Processing...');
            $("#btn_Forgot_Password").attr('disabled',true);
            CallAjax(data,1,'forgot_password');
        });
        function CallAjax(data,route,action){
            $.ajax({
                type: 'POST',
                url: 'ajax_url.php?action='+action,
                data: data,
                dataType:'json',
                success: function(evt){
                    CallAjaxSendCode(data,1);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('error: ' + textStatus + ': ' + errorThrown);
                }
            });
        }
        function ReturnAjax(data){
            if(data['Result'] == 'Success'){
                $("#btn_Forgot_Password").text('SUBMIT');
                $("#btn_Forgot_Password").attr('disabled',false);
                Message(2,'Request successfully submitted, Please check your email');
            }
            else{
                Message(1,'Invalid Account');
                $("#btn_Forgot_Password").text('SUBMIT');
                $("#btn_Forgot_Password").attr('disabled',false);
            }
        }
        function CallAjaxSendCode(data,route){
            $.ajax({
                type: 'POST',
                url: 'mail_send_forgotpass.php',
                data: data,
                dataType:'json',
                success: function(evt){
                    switch(route){
                        case 1:ReturnAjax(evt);break;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('error: ' + textStatus + ': ' + errorThrown);
                }
            });
        }
    </script>