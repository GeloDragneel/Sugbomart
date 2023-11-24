<?php include('header.php'); ?>
<style>
    :root {
        --theme-yellow:   #000;
        --theme-black:    #101820FF;
        --theme-gray:       #8892B0;
    }
    #experienceTab.nav-pills .nav-link.active {
        color: var(--theme-yellow) !important;
        background-color: transparent;
        border-radius: 0px;
        border-left: 3px solid var(--theme-yellow);
    }
    #experienceTab.nav-pills .nav-link {
        border-radius: 0px;
        border-left: 2px solid var(--theme-gray);
    }
    .date-range {
        letter-spacing: 0.01em;
        color: var(--theme-gray);
    }
    a {
        color: var(--theme-gray);
        transition: 0.3s eas-in-out;
    }
    a.nav-link:hover {
        color: var(--theme-yellow);
    }
    p {
        margin: 0;
    }
    .upload__inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    .upload__btn {
        display: inline-block;
        font-weight: 600;
        color: #fff;
        text-align: center;
        min-width: 116px;
        padding: 5px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid;
        border-color: #4045ba;
        border-radius: 5px;
        line-height: 26px;
        font-size: 14px;
    }
    .upload__btn:hover {
        background-color: unset;
        color: #4045ba;
        transition: all 0.3s ease;
    }
    .upload__btn-box {
        margin-bottom: 10px;
    }
    .upload__img-wrap {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    .upload__img-box {
        width: 200px;
        padding: 0 10px;
        margin-bottom: 12px;
    }
    .upload__img-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
    }
    .upload__img-close:after {
        content: '\2716';
        font-size: 14px;
        color: white;
    }
    .img-bg {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        padding-bottom: 100%;
    }
    
</style>
<?php

    $FirstName = '';
    $LastName = '';
    $Address = '';
    $Address2 = '';
    $Email = '';
    $PhoneNumber = '';

    $query = "SELECT * FROM `user` WHERE ID = " . $UserID;
    if ($result = $mysqli->query($query)) {
        while($row = $result->fetch_array()){
            $FirstName = $row['FirstName'];
            $LastName = $row['LastName'];
            $Address = $row['Address'];
            $Address2 = $row['Address2'];
            $Email = $row['Email'];
            $PhoneNumber = $row['PhoneNumber'];
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
                    <h2>My Account</h2>
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
        <div class="row p-5">
            <div class="col-md-2 mb-3">
                <ul class="nav nav-pills flex-column" id="experienceTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#snit" role="tab" aria-controls="home" aria-selected="true">Information</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10">
                <div class="tab-content" id="experienceTabContent">
                    <div class="tab-pane fade show active text-right" id="snit" role="tabpanel" aria-labelledby="home-tab">
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="FirstName">First Name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="FirstName" value="<?=$FirstName?>" placeholder="Enter First Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="LastName">Last Name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="LastName" value="<?=$LastName?>" placeholder="Enter Last Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="Address">Address 1:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="Address" rows="5"><?=$Address?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="Address2">Address 2:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="Address2" rows="5"><?=$Address2?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="Email">Email:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Email" value="<?=$Email?>" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="PhoneNumber">Phone Number:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="PhoneNumber" value="<?=$PhoneNumber?>" placeholder="Enter Phone Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2">&nbsp;</label>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-primary btn_Save_Information">Save Information</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<script>
    $(".btn_Save_Information").on("click",function(){
        SaveInformation();
    });
    function SaveInformation(){
        var ID = parseInt('<?=$UserID?>');
        var FirstName = $("#FirstName").val();
        var LastName = $("#LastName").val();
        var Address = $("#Address").val();
        var Address2 = $("#Address2").val();
        var Email = $("#Email").val();
        var PhoneNumber = $("#PhoneNumber").val();
        var data = {
            ID : ID,
            FirstName : FirstName,
            LastName : LastName,
            Address : Address,
            Address2 : Address2,
            Email : Email,
            PhoneNumber : PhoneNumber,
        }
        CallAjax(data,1,'save_shopper_info');
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
                    case 1:
                        Message(2,'Profile Successfully Updated');
                    break;
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('error: ' + textStatus + ': ' + errorThrown);
            }
        });
    }
</script>