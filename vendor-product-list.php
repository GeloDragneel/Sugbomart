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
                        <h2>Product List</h2>
                        <div class="breadcrumb__option">
                            <span>Page info</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="contact-form spad">
        <div class="container-fluid">
            <div class="row">
                <table class="table table-bordered cell-border" id="table_MyOrder">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Product Name</th>
                            <th>Store Name</th>
                            <th>Price</th>
                            <th>Discounted Price</th>
                            <th>Quantity</th>
                            <th>Sold Qty</th>
                            <th>Expiry Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
                            $query = "SELECT a.ID,a.ProductName,a.Price,a.DiscountedPrice,a.Quantity,a.ExpiryDate,b.StoreName FROM `products` a INNER JOIN `store` b ON b.ID = a.StoreID ORDER BY a.ID DESC";
                            if ($result = $mysqli->query($query)) {
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_array()){
                                        $ProductID = $row['ID'];
                                        $count = count(getImage($row['ID']));
                                        if($count == 0){
                                            $Img = "img/product/empty.jpg";
                                        }
                                        else{
                                            $Img = getImage($row['ID'])[0];
                                            $Img = "img/product/".$Img."?v=" . date('Ymdhis');
                                        }

                                        $cartRow = $mysqli->query("SELECT COALESCE(SUM(Quantity),0) AS Quantity FROM `cart` WHERE ProductID = $ProductID AND `Status` = 1")->fetch_array();
                                        $OrderQty = $cartRow['Quantity'];

                                        $mysqldate = $row['ExpiryDate'];
                                        $phpdate = strtotime( $mysqldate );
                                        $ExpiryDate = date( 'M d Y', $phpdate );

                                        echo '
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="avatar me-2">
                                                        <img src="'.$Img.'" alt="image" class="rounded-circle img-fluid">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>'.$row['ProductName'].'</td>
                                            <td>'.$row['StoreName'].'</td>
                                            <td>'.$row['Price'].'</td>
                                            <td>'.$row['DiscountedPrice'].'</td>
                                            <td>'.$row['Quantity'].'</td>
                                            <td>'.$OrderQty.'</td>
                                            <td>'.$ExpiryDate.'</td>
                                            <td class="text-center hand-cursor">
                                                <a class="btn btn-info btn-sm" href="vendor-product-list-info?id='.$row['ID'].'"><i class="fa fa-pencil"></i> Edit</a> 
                                                <a class="btn btn-danger btn-sm btn_Delete_Record" RecordID="'.$row['ID'].'"><i class="fa fa-times"></i> Delete</a>
                                            </td>
                                        </tr>';
                                    }
                                }
                                else{echo '<tr><td colspan="5">No Product Yet</td></tr>';}
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script>
        $(document).ready( function () {
            $('#table_MyOrder').DataTable({
                dom: "<'dt--top-section'<'row'<'col-sm-12 col-md-2 d-flex justify-content-md-start justify-content-center pr-0'f><'col-sm-12 col-md-4 d-flex justify-content-left'<'adv_button'>><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'B>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-length mb-sm-0 mb-3'l><'dt--pagination mb-sm-0 mb-3'p><'dt--pages-count'i>>",
                oLanguage: {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                    sEmptyTable: "No Record Found",
                    sZeroRecords : "No Record Found",
                },
                columnDefs:[
                    {targets: [0],width: '5%',},
                    {targets: [1],width: '20%',},
                    {targets: [2],width: '15%',},
                    {targets: [3],width: '10%',},
                    {targets: [4],width: '9%',},
                    {targets: [5],width: '9%',},
                    {targets: [6],width: '9%',}, //
                    {targets: [7],width: '9%',},
                    {targets: [8],width: '13%',},
                ],
                buttons: [
                    {
                        text: 'Add New Product',
                        className: 'btn btn-info toggle-vis mb-1',
                        action: function(e, dt, node, config ) {
                            window.location = 'vendor-product-list-info?id=0'
                        }
                    },
                ],
                ordering:false,
                autoWidth:false,
                stripeClasses: [],
                lengthMenu: [[10, 20, -1], [10, 20, "All"]],
                pageLength: 10
            });
            $(".btn_Delete_Record").on("click",function(){
                var RecordID = $(this).attr('RecordID');
                var data = {RecordID : RecordID};
                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Delete Record',
                    message: 'Are you sure about that?',
                    position: 'center',
                    buttons: [
                        ['<button fdprocessedid="4v4adk"><b>YES</b></button>', function (instance, toast) {
                            CallAjax(data,1,'delete_product');
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        }, true],
                        ['<button fdprocessedid="h6al">NO</button>', function (instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        }],
                    ],
                    onClosing: function(instance, toast, closedBy){
                        console.info('Closing | closedBy: ' + closedBy);
                    },
                    onClosed: function(instance, toast, closedBy){
                        console.info('Closed | closedBy: ' + closedBy);
                    }
                });
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
                                Message(2,'Product Successfully deleted');
                                setTimeout(function() { 
                                    location.reload();
                                }, 1000);
                            break;
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        console.log('error: ' + textStatus + ': ' + errorThrown);
                    }
                });
            }
        })
    </script>