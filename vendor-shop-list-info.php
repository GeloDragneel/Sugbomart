<?php include('header.php'); ?>
<?php 
    require("connection/db.php");
    $StoreName = '';
    $StoreAddress = '';
    $query = "SELECT * FROM `store` WHERE ID = " . $_GET['id'];
    if ($result = $mysqli->query($query)) {
        while($row = $result->fetch_array()){
            $StoreName = $row['StoreName'];
            $StoreAddress = $row['StoreAddress'];
        }
    }
?>
<style>
    @import url(https://fonts.googleapis.com/icon?family=Material+Icons);
    @import url('https://fonts.googleapis.com/css?family=Raleway');
    .wrapper {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }
    .box {
        display: block;
        min-width: 300px;
        height: 300px;
        margin: 10px 0px 10px 0px;
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        overflow: hidden;
    }
    .upload-options {
        position: relative;
        height: 75px;
        background-color: cadetblue;
        cursor: pointer;
        overflow: hidden;
        text-align: center;
        transition: background-color ease-in-out 150ms;
    }
    .upload-options:hover {
        background-color: #7fb1b3;
    }
    .upload-options input {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    .upload-options label {
        display: flex;
        align-items: center;
        width: 100%;
        height: 100%;
        font-weight: 400;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
        overflow: hidden;
    }
    .upload-options label::after {
        content: 'add';
        font-family: 'Material Icons';
        position: absolute;
        font-size: 2.5rem;
        color: rgba(230, 230, 230, 1);
        top: calc(50% - 2.5rem);
        left: calc(50% - 1.25rem);
        z-index: 0;
    }
    .upload-options label span {
        display: inline-block;
        width: 50%;
        height: 100%;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        vertical-align: middle;
        text-align: center;
    }
    .upload-options label span:hover i.material-icons {
        color: lightgray;
    }
    .js--image-preview {
        height: 225px;
        width: 100%;
        position: relative;
        overflow: hidden;
        background-image: url('');
        background-color: white;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .js--image-preview::after {
        content: "photo_size_select_actual";
        font-family: 'Material Icons';
        position: relative;
        font-size: 4.5em;
        color: rgba(230, 230, 230, 1);
        top: calc(50% - 3rem);
        left: calc(50% - 2.25rem);
        z-index: 0;
    }
    .js--image-preview.js--no-default::after {
        display: none;
    }
    .js--image-preview:nth-child(2) {
        background-image: url('http://bastianandre.at/giphy.gif');
    }
    i.material-icons {
        transition: color 100ms ease-in-out;
        font-size: 2.25em;
        line-height: 55px;
        color: white;
        display: block;
    }
    .drop {
        display: block;
        position: absolute;
        background: rgba(95, 158, 160, 0.2);
        border-radius: 100%;
        transform: scale(0);
    }
    .animate {
        animation: ripple 0.4s linear;
    }
    @keyframes ripple {
        100% {
            opacity: 0;
            transform: scale(2.5);
        }
    }
    .js--image-preview{
        background-size:contain;
    }
</style>
    <!-- Hero Section Begin -->
    <?php include('header-middle.php'); ?>
    <!-- Hero Section End -->
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shop Information</h2>
                        <div class="breadcrumb__option">
                            <span><a href="vendor-shop-list">Back to shop list</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrapper">
                        <div class="col-md-4">
                            <p class="text-center">Shop Profile</p>
                            <div class="box">
                                <div class="js--image-preview js--no-default" style="background-image:url('img/store/feature-<?=$_GET['id']?>.webp?v=<?php echo date('Ymdhis') ?>')"></div>
                                <div class="upload-options">
                                    <label><input type="file" class="image-upload" id="FileImage" accept="image/*" /></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p class="text-center">Business Permit</p>
                            <div class="box">
                                <div class="js--image-preview js--no-default" style="background-image:url('img/business_permit/feature-<?=$_GET['id']?>.webp?v=<?php echo date('Ymdhis') ?>')"></div>
                                <div class="upload-options">
                                    <label><input type="file" class="image-upload" id="FileImage2" accept="image/*" /></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p class="text-center">Sanitary Permit</p>
                            <div class="box">
                                <div class="js--image-preview js--no-default" style="background-image:url('img/sanitary_permit/feature-<?=$_GET['id']?>.webp?v=<?php echo date('Ymdhis') ?>')"></div>
                                <div class="upload-options">
                                    <label><input type="file" class="image-upload" id="FileImage3" accept="image/*" /></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-sm-12" for="StoreName">Store Name:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="StoreName" value="<?=$StoreName?>" placeholder="Enter Store Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-12" for="StoreAddress">Store Address:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="StoreAddress" value="<?=$StoreAddress?>" placeholder="Enter Store Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-primary" id="btn_Save_info">Save Information</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script>
        $("#btn_Save_info").on("click",function(){
            SaveInformation();
        });
        function SaveInformation(){
            var ID = parseInt('<?=$_GET['id']?>');
            var StoreName = $("#StoreName").val();
            var StoreAddress = $("#StoreAddress").val();
            var data = {
                ID : ID,
                StoreName : StoreName,
                StoreAddress : StoreAddress,
            }
            CallAjax(data,1,'save_shop');
        }
        function UploadImage(ID){
            var FileImage = $('#FileImage')[0].files;
            var form_Data = new FormData();
            form_Data.append('file', FileImage[0]);
            form_Data.append('ID', ID);
            $.ajax({
                url: 'ajax_url.php?action=upload_shop_img', 
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: form_Data,
                type: 'post',
                success: function(evt){
                    console.log(evt);
                }
            });
        }
        function UploadImage2(ID){
            var FileImage2 = $('#FileImage2')[0].files;
            var form_Data = new FormData();
            form_Data.append('file', FileImage2[0]);
            form_Data.append('ID', ID);
            $.ajax({
                url: 'ajax_url.php?action=upload_shop_img2', 
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: form_Data,
                type: 'post',
                success: function(evt){
                    console.log(evt);
                }
            });
        }
        function UploadImage3(ID){
            var FileImage3 = $('#FileImage3')[0].files;
            var form_Data = new FormData();
            form_Data.append('file', FileImage3[0]);
            form_Data.append('ID', ID);
            $.ajax({
                url: 'ajax_url.php?action=upload_shop_img3', 
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: form_Data,
                type: 'post',
                success: function(evt){
                    console.log(evt);
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
                            UploadImage(evt['Result']);
                            UploadImage2(evt['Result']);
                            UploadImage3(evt['Result']);
                            Message(2,'Shop Successfully saved');
                            setTimeout(function() { 
                                window.location = 'vendor-shop-list-info?id=' + evt['Result'];
                            }, 1000);
                        break;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('error: ' + textStatus + ': ' + errorThrown);
                }
            });
        }
        function initImageUpload(box) {
            let uploadField = box.querySelector('.image-upload');
            uploadField.addEventListener('change', getFile);
            function getFile(e){
                let file = e.currentTarget.files[0];
                checkType(file);
            }
            function previewImage(file){
                let thumb = box.querySelector('.js--image-preview'),
                    reader = new FileReader();

                reader.onload = function() {
                thumb.style.backgroundImage = 'url(' + reader.result + ')';
                }
                reader.readAsDataURL(file);
                thumb.className += ' js--no-default';
            }
            function checkType(file){
                let imageType = /image.*/;
                if (!file.type.match(imageType)) {
                throw 'Datei ist kein Bild';
                } else if (!file){
                throw 'Kein Bild gewählt';
                } else {
                previewImage(file);
                }
            }
        }
        var boxes = document.querySelectorAll('.box');
        for (let i = 0; i < boxes.length; i++) {
            let box = boxes[i];
            initDropEffect(box);
            initImageUpload(box);
        }
        function initDropEffect(box){
            let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;
            
            // get clickable area for drop effect
            area = box.querySelector('.js--image-preview');
            area.addEventListener('click', fireRipple);
            
            function fireRipple(e){
                area = e.currentTarget
                // create drop
                if(!drop){
                    drop = document.createElement('span');
                    drop.className = 'drop';
                    this.appendChild(drop);
            }
            // reset animate class
            drop.className = 'drop';
            
            // calculate dimensions of area (longest side)
            areaWidth = getComputedStyle(this, null).getPropertyValue("width");
            areaHeight = getComputedStyle(this, null).getPropertyValue("height");
            maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

            // set drop dimensions to fill area
            drop.style.width = maxDistance + 'px';
            drop.style.height = maxDistance + 'px';
            
            // calculate dimensions of drop
            dropWidth = getComputedStyle(this, null).getPropertyValue("width");
            dropHeight = getComputedStyle(this, null).getPropertyValue("height");
            
            // calculate relative coordinates of click
            // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
            x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10)/2);
            y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10)/2) - 30;
            
            // position drop and animate
            drop.style.top = y + 'px';
            drop.style.left = x + 'px';
            drop.className += ' animate';
            e.stopPropagation();
            }
        }
    </script>