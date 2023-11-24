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
                                <input placeholder="What do yo u need?">
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
                        <h2>One Time Password (OTP)</h2>
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
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <form>
                        <div class="row">
                            <div class="col-lg-2 text-left">
                                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control code1">
                            </div>
                            <div class="col-lg-2 text-left">
                                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control code2">
                            </div>
                            <div class="col-lg-2 text-left">
                                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control code3">
                            </div>
                            <div class="col-lg-2 text-left">
                                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control code4">
                            </div>
                            <div class="col-lg-2 text-left">
                                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control code5">
                            </div>
                            <div class="col-lg-2 text-left">
                                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control code6">
                            </div>
                            <div class="col-lg-12 col-md-12 text-left">
                                <label>&nbsp;</label>
                                <input type="button" class="site-btn" id="btn_Verify_Account" value="VERIFY" style="color: #fff;">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script>


        $("#btn_Verify_Account").on("click",function(){
            VerifyCode(1,null);
        });
        function VerifyCode(route,data){
            switch(route){
                case 1:
                    if($(".code1").val() == ''){
                        $(".code1").focus();
                        return;
                    }
                    if($(".code2").val() == ''){
                        $(".code2").focus();
                        return;
                    }
                    if($(".code3").val() == ''){
                        $(".code3").focus();
                        return;
                    }
                    if($(".code4").val() == ''){
                        $(".code4").focus();
                        return;
                    }
                    if($(".code5").val() == ''){
                        $(".code5").focus();
                        return;
                    }
                    if($(".code6").val() == ''){
                        $(".code6").focus();
                        return;
                    }
                    var VerificationCode = $(".code1").val()+''+$(".code2").val()+''+$(".code3").val()+''+$(".code4").val()+''+$(".code5").val()+''+$(".code6").val();
                    var data = {
                        email_address : '<?=$_GET['email']?>',
                        verification_code : VerificationCode
                    }
                    CallAjax(data,1,'verify_code');
                break;
                case 2:
                    if(data['Result'] == 'NotFound'){
                        Message(1,'Invalid verification code');
                        return;
                    }
                    else if(data['Result'] == 'Exists'){
                        Message(1,'Code already verified');
                        return;
                    }
                    else{
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
                        case 1:VerifyCode(2,evt);break;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('error: ' + textStatus + ': ' + errorThrown);
                }
            });
        }
        const form = document.querySelector('form')
        const inputs = form.querySelectorAll('input')
        const KEYBOARDS = {
            backspace: 8,
            arrowLeft: 37,
            arrowRight: 39,
        }
        function handleInput(e) {
            const input = e.target
            const nextInput = input.nextElementSibling
            if (nextInput && input.value) {
                nextInput.focus()
                if (nextInput.value) {
                    nextInput.select()
                }
            }
        }
        function handlePaste(e) {
            e.preventDefault()
            const paste = e.clipboardData.getData('text')
            inputs.forEach((input, i) => {
                input.value = paste[i] || ''
            })
        }
        function handleBackspace(e) {
            const input = e.target
            if (input.value) {
                input.value = ''
                return
            }

            input.previousElementSibling.focus()
        }
        function handleArrowLeft(e) {
            const previousInput = e.target.previousElementSibling
            if (!previousInput) return
            previousInput.focus()
        }
        function handleArrowRight(e) {
            const nextInput = e.target.nextElementSibling
            if (!nextInput) return
            nextInput.focus()
        }
        form.addEventListener('input', handleInput);
        inputs[0].addEventListener('paste', handlePaste);
        inputs.forEach(input => {
            input.addEventListener('focus', e => {
                setTimeout(() => {
                    e.target.select()
                }, 0)
            })
            input.addEventListener('keydown', e => {
                switch (e.keyCode) {
                    case KEYBOARDS.backspace:
                        handleBackspace(e)
                        break
                    case KEYBOARDS.arrowLeft:
                        handleArrowLeft(e)
                        break
                    case KEYBOARDS.arrowRight:
                        handleArrowRight(e)
                        break
                    default:
                }
            })
        });
    </script>