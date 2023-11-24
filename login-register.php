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
            width: 22px;
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
            color: #06c;
        }
        .tabset > label:hover::after,
        .tabset > input:focus + label::after,
        .tabset > input:checked + label::after {
            background: #06c;
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
                        <h2>Login / Register</h2>
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
            <div class="tabset">
                <!-- Tab 1 -->
                <input type="radio" name="tabset" id="tab1" aria-controls="Customer" checked>
                <label for="tab1">Customer</label>
                <!-- Tab 2 -->
                <input type="radio" name="tabset" id="tab2" aria-controls="Vendor">
                <label for="tab2">Vendor</label>
                <div class="tab-panels">
                    <section id="Customer" class="tab-panel">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="contact__form__title text-left">
                                    <h2>Login</h2>
                                </div>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <label>Email</label>
                                            <input type="text" id="LoginUser">
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <label>Password</label>
                                            <input type="password" id="LoginPassword">
                                        </div>
                                        <div class="col-lg-12 text-left">
                                            <button type="button" class="site-btn" id="btn_Submit_Login">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6">
                                <div class="contact__form__title text-left">
                                    <h2>Register</h2>
                                </div>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <label>Email</label>
                                            <input type="text" id="reg_Email">
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label>Password</label>
                                            <input type="password" id="reg_Password">
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label>First Name</label>
                                            <input type="text" id="reg_FirstName">
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label>Last Name</label>
                                            <input type="text" id="reg_LastName">
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label>Phone Number</label>
                                            <input type="text" id="reg_PhoneNumber">
                                        </div>
                                        <div class="col-lg-12 text-left">
                                            <button type="button" class="site-btn" id="btn_Register">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                    <section id="Vendor" class="tab-panel">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="contact__form__title text-left">
                                    <h2>Login</h2>
                                </div>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <label>Email</label>
                                            <input type="text" id="LoginUser">
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <label>Password</label>
                                            <input type="password" id="LoginPassword">
                                        </div>
                                        <div class="col-lg-12 text-left">
                                            <button type="button" class="site-btn" id="btn_Submit_Login">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6">
                                <div class="contact__form__title text-left">
                                    <h2>Register</h2>
                                </div>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <label>Email</label>
                                            <input type="text" id="reg_Email">
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label>Password</label>
                                            <input type="password" id="reg_Password">
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label>First Name</label>
                                            <input type="text" id="reg_FirstName">
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label>Last Name</label>
                                            <input type="text" id="reg_LastName">
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label>Phone Number</label>
                                            <input type="text" id="reg_PhoneNumber">
                                        </div>
                                        <div class="col-lg-12 text-left">
                                            <button type="button" class="site-btn" id="btn_Register">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
        $("#btn_Submit_Login").on("click",function(){
            Login(1,null);
        });
        function Register(route,data){
            switch(route){
                case 1:
                    var Email = $("#reg_Email").val();
                    var Password = $("#reg_Password").val();
                    var FirstName = $("#reg_FirstName").val();
                    var LastName = $("#reg_LastName").val();
                    var ShopName = $("#reg_ShopName").val();
                    var BusinessPermit = $("#reg_Business_Permit").val();
                    var PhoneNumber = $("#reg_PhoneNumber").val();
                    var UserType = 0;
                    if($("#rad_Customer").is(":checked")){
                        UserType = 1;
                    }
                    if($("#rad_Vendor").is(":checked")){
                        UserType = 2;
                    }
                    if(Email == ''){
                        Message(1,'Email is required');
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
                        UserType : UserType
                    };
                    CallAjax(data,1,'register');
                break;
                case 2:
                    if(data['Result'] == 1){
                        $("#FirstName").val("");
                        $("#LastName").val("");
                        $("#ShopName").val("");
                        $("#BusinessPermit").val("");
                        $("#PhoneNumber").val("");
                        $("#Email").val("");
                        $("#Password").val("");
                        Message(2,'Registration successfully submitted, Please wait for admin approval');
                    }
                break;
            }
        }
        function Login(route,data){
            switch(route){
                case 1:
                    var LoginUser = $("#LoginUser").val();
                    var LoginPassword = $("#LoginPassword").val();
                    if(LoginUser == ''){
                        Message(1,'Please input username');
                        return;
                    }
                    if(LoginPassword == ''){
                        Message(1,'Please input password');
                        return;
                    }
                    var data = {
                        LoginUser : LoginUser,
                        LoginPassword : LoginPassword,
                    };
                    CallAjax(data,2,'login');
                break;
                case 2:
                    if(data['Result'] == 'Success'){
                        switch(parseInt(data['UserType'])){
                            case 1:
                                window.location = "index";
                            break;
                            case 2:
                                window.location = "vendor-dashboard";
                            break;
                            default:
                                window.location = "admin-dashboard";
                            break;
                        }
                    } 
                    else if (data['Result'] == "Pending"){
                        Message(1,'Account is pending, Please wait for approval');
                    }
                    else if (data['Result'] == "Declined"){
                        Message(1,'Sorry, Your account has been declined');
                    }
                    else if (data['Result'] == "Deactivated"){
                        Message(1,'Sorry, Your account has been deactivated');
                    }
                    else{
                        Message(1,'Invalid Username or Password');
                    }
                break;
            }
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
                        case 1:Register(2,evt);break;
                        case 2:Login(2,evt);break;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('error: ' + textStatus + ': ' + errorThrown);
                }
            });
        }
    </script>