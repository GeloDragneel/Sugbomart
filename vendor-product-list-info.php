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
    require("connection/db.php");
    $ProductName = '';
    $ProductDesc = '';
    $ProductInfo = '';
    $Price = '';
    $DiscountedPrice = '';
    $Quantity = '';
    $StoreID = 0;
    $countImages = 0;
    $ExpiryDate = 0;
    $Unit = 0;
    $CategoryID = 0;
    
    $ProductID = $_GET['id'];
    $query = "SELECT * FROM `products` WHERE ID = " . $_GET['id'];
    if ($result = $mysqli->query($query)) {
        while($row = $result->fetch_array()){
            $cartRow = $mysqli->query("SELECT COALESCE(SUM(Quantity),0) AS Quantity FROM `cart` WHERE ProductID = $ProductID AND `Status` = 1")->fetch_array();
            $OrderQty = $cartRow['Quantity'];

            $ProductName = $row['ProductName'];
            $ProductDesc = $row['ProductDesc'];
            $ProductInfo = $row['ProductInfo'];
            $Price = $row['Price'];
            $DiscountedPrice = $row['DiscountedPrice'];
            $Quantity = $row['Quantity'];
            $StoreID = $row['StoreID'];
            $ExpiryDate = $row['ExpiryDate'];
            $Unit = $row['Unit'];
            $CategoryID = $row['CategoryID'];

            $RemQty = $row['Quantity'] - $OrderQty;
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
                    <h2>Product Information</h2>
                    <div class="breadcrumb__option">
                        <span><a href="vendor-product-list">Back to product list</a></span>
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
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#devs" role="tab" aria-controls="profile" aria-selected="false">Product Gallery</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10">
                <div class="tab-content" id="experienceTabContent">
                    <div class="tab-pane fade show active text-right" id="snit" role="tabpanel" aria-labelledby="home-tab">
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="ProductName">Store Name:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="StoreID" style="width:100%">
                                <?php 
                                    $query = "SELECT * FROM `store` WHERE UserID = $UserID";
                                    if ($result = $mysqli->query($query)){
                                        while($row = $result->fetch_array()){
                                            $selected = ($StoreID == $row['ID'] ? 'selected' : '');
                                            echo '<option '.$selected.' value="'.$row['ID'].'">' . $row['StoreName'] . '</option>';
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="ProductName">Category Name:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="CategoryID" style="width:100%">
                                <option value="0">Select Category</option>
                                <?php 
                                    $query = "SELECT * FROM category ORDER BY CategoryName ASC";
                                    if ($result = $mysqli->query($query)){
                                        while($row = $result->fetch_array()){
                                            $selected = ($CategoryID == $row['ID'] ? 'selected' : '');
                                            echo '<option '.$selected.' value="'.$row['ID'].'">' . $row['CategoryName'] . '</option>';
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="ProductName">Product Name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ProductName" value="<?=$ProductName?>" placeholder="Enter Product Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="ProductDesc">Product Description:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="ProductDesc" rows="5"><?=$ProductDesc?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="ProductInfo">Product Information:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="ProductInfo" rows="5"><?=$ProductInfo?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="Price">Product Price:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="Price" value="<?=$Price?>" placeholder="Enter Price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="Price">Discounted Price:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="DiscountedPrice" value="<?=$DiscountedPrice?>" placeholder="Enter Discounted Price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="Unit">Per Unit:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="Unit">
                                    <option value="0" <?php if($Unit == 0){echo 'selected';} ?>>Select</option>
                                    <option value="KG" <?php if($Unit == "KG"){echo 'selected';} ?>>KG</option>
                                    <option value="PCS" <?php if($Unit == "PCS"){echo 'selected';} ?>>PCS</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="Quantity">PCS / KG:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="Quantity" value="<?=$Quantity?>" placeholder="Enter Quantity">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2" for="ExpiryDate">Expiry Days:</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="ExpiryDate" value="<?=$ExpiryDate?>" placeholder="Enter Expiry Days">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 mt-2">&nbsp;</label>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-primary btn_Save_Information">Save Information</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade text-left" id="devs" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="upload__box">
                            <div class="upload__btn-box">
                                <label class="upload__btn">
                                    <p>Upload images</p>
                                    <input type="file" multiple="" id='filesImages' name="filesImages[]" data-max_length="20" class="upload__inputfile">
                                </label>
                            </div>
                            <div class="upload__img-wrap">
                                <?php
                                    if($_GET['id'] != 0){
                                        $dir = 'img/product/';
                                        $files2 = scandir($dir, SCANDIR_SORT_ASCENDING);
                                        foreach($files2 as $img){
                                            $haystack = $img;
                                            $needle   = '_';
                                            if (strpos($haystack, $needle) !== false) {
                                                $String = explode("_",$img);
                                                $Ver = date('Ymdhis');
                                                if($String[0] == $_GET['id']){
                                                    $url = 'img/product/' . $img;
                                                    $img = 'img/product/' . $img.'?v='.$Ver;
                                                    echo '<div class="upload__img-box"><div style="background-image:url('.$img.')" data-number="'.$countImages.'" data-file="" class="img-bg"><div class="upload__img-close old" url="'.$url.'"></div></div></div>';
                                                    $countImages++;
                                                }
                                            }
                                        }
                                    }
                                ?>
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
        var ID = parseInt('<?=$_GET['id']?>');
        var ProductName = $("#ProductName").val();
        var ProductDesc = $("#ProductDesc").val();
        var ProductInfo = $("#ProductInfo").val();
        var Price = $("#Price").val();
        var DiscountedPrice = $("#DiscountedPrice").val();
        var Quantity = $("#Quantity").val();
        var ExpiryDate = $("#ExpiryDate").val();
        var Unit = $("#Unit").val();
        var StoreID = $("#StoreID").find("option:selected").val();
        var CategoryID = $("#CategoryID").find("option:selected").val();
        var data = {
            ID : ID,
            ProductName : ProductName,
            ProductDesc : ProductDesc,
            ProductInfo : ProductInfo,
            Price : Price,
            DiscountedPrice : DiscountedPrice,
            Quantity : Quantity,
            ExpiryDate : ExpiryDate,
            Unit : Unit,
            StoreID : StoreID,
            CategoryID : CategoryID,
        }
        CallAjax(data,1,'save_product');
    }
    function UploadImages(ProductID){
        var form_data = new FormData();
        var totalfiles = document.getElementById('filesImages').files.length;
        for (var index = 0; index < totalfiles; index++) {
            form_data.append("filesImages[]", document.getElementById('filesImages').files[index]);
            form_data.append('ProductID', ProductID);
        }
        $.ajax({
            url: 'ajax_url.php?action=upload_product_img', 
            type: 'post',
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
            }
        });
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
                        UploadImages(evt['Result']);
                        Message(2,'Product Successfully saved');
                        setTimeout(function() { 
                            window.location = 'vendor-product-list-info?id=' + evt['Result'];
                        }, 1000);
                    break;
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('error: ' + textStatus + ': ' + errorThrown);
            }
        });
    }
    $(document).ready(function() {
        ImgUpload();
    });
    function ImgUpload() {
        var imgWrap = "";
        var imgArray = [];
        $('.upload__inputfile').each(function() {
            $(this).on('change', function(e) {
                imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                var maxLength = $(this).attr('data-max_length');

                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                var iterator = 0;
                filesArr.forEach(function(f, index) {

                    if (!f.type.match('image.*')) {
                        return;
                    }

                    if (imgArray.length > maxLength) {
                        return false
                    } else {
                        var len = 0;
                        for (var i = 0; i < imgArray.length; i++) {
                            if (imgArray[i] !== undefined) {
                                len++;
                            }
                        }
                        if (len > maxLength) {
                            return false;
                        } else {
                            imgArray.push(f);
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close new'></div></div></div>";
                                imgWrap.append(html);
                                iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    }
                });
            });
        });

        $('body').on('click', ".upload__img-close", function(e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
                if (imgArray[i].name === file) {
                    imgArray.splice(i, 1);
                    break;
                }
            }
            $(this).parent().parent().remove();
            if($(this).hasClass('old')){
                var Link = $(this).attr('url');
                var data = {Link : Link};
                CallAjax(data,null,'unlink_image');
            }
        });
    }
</script>