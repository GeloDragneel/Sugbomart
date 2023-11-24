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
                        <h2>Vendor List</h2>
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
                <table class="table table-bordered" id="table_MyOrder">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Shop Name</th>
                            <th>Business Permit</th>
                            <th>Date Registered</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 0;
                            $SubTotal = 0;
                            require("connection/db.php");
                            $query = "SELECT * FROM `user` WHERE `UserType` = 2 ORDER BY ID DESC";
                            if ($result = $mysqli->query($query)) {
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_array()){
                                        $mysqldate = $row['date_added'];
                                        $phpdate = strtotime( $mysqldate );
                                        $mysqldate = date( 'M d Y - h:i:s a', $phpdate );
                                        $Status = '';
                                        $button0 = '';
                                        $button1 = '';
                                        if($row['Status'] == 0){
                                            $Status = '<span class="badge badge-warning">Pending</span>';
                                            $button0 = '<a class="btn btn-info btn-sm btn_Confirm"  RecordID="'.$row['ID'].'"><i class="fa fa-thumbs-up"></i> Confirm</a>';
                                            $button1 = '<a class="btn btn-danger btn-sm btn_Delete_Record" RecordID="'.$row['ID'].'"><i class="fa fa-times"></i> Delete</a>';
                                        }
                                        if($row['Status'] == 1){
                                            $Status = '<span class="badge badge-success">Active</span>';
                                            $button1 = '<a class="btn btn-danger btn-sm btn_DeActivate" RecordID="'.$row['ID'].'"><i class="fa fa-times"></i> Deactivate</a>';
                                        }
                                        if($row['Status'] == 2){
                                            $Status = '<span class="badge badge-danger">In-Active</span>';
                                            $button1 = '<a class="btn btn-success btn-sm btn_Activate" RecordID="'.$row['ID'].'"><i class="fa fa-check"></i> Activate</a>';
                                        }
                                        if($row['Status'] == 3){
                                            $Status = '<span class="badge badge-warning">Declined</span>';
                                        }
                                        echo '
                                        <tr>
                                            <td>'.$row['FirstName'].'</td>
                                            <td>'.$row['LastName'].'</td>
                                            <td>'.$row['PhoneNumber'].'</td>
                                            <td>'.$row['Email'].'</td>
                                            <td>'.$row['ShopName'].'</td>
                                            <td>'.$row['BusinessPermit'].'</td>
                                            <td>'.$mysqldate.'</td>
                                            <td>'.$Status.'</td>
                                            <td class="text-center hand-cursor">
                                                '.$button0.'
                                                '.$button1.'
                                            </td>
                                        </tr>';
                                    }
                                }
                                else{echo '<tr><td colspan="5">No Order Yet</td></tr>';}
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
                dom: "<'dt--top-section'<'row'<'col-sm-12 col-md-2 d-flex justify-content-md-start justify-content-center pr-0'f><'col-sm-12 col-md-4 d-flex justify-content-left'<'adv_button'>><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'>>>" +
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
                ordering:false,
                autoWidth:false,
                stripeClasses: [],
                lengthMenu: [[10, 20, -1], [10, 20, "All"]],
                pageLength: 10
            });
            $(".btn_DeActivate").on("click",function(){
                var RecordID = $(this).attr('RecordID');
                var data = {RecordID : RecordID, Status : 2};
                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Deactivate Record',
                    message: 'Are you sure about that?',
                    position: 'center',
                    buttons: [
                        ['<button fdprocessedid="4v4adk"><b>YES</b></button>', function (instance, toast) {
                            CallAjax(data,1,'update_user_status');
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
            $(".btn_Activate").on("click",function(){
                var RecordID = $(this).attr('RecordID');
                var data = {RecordID : RecordID, Status : 1};
                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Activate Record',
                    message: 'Are you sure about that?',
                    position: 'center',
                    buttons: [
                        ['<button fdprocessedid="4v4adk"><b>YES</b></button>', function (instance, toast) {
                            CallAjax(data,2,'update_user_status');
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
            $(".btn_Confirm").on("click",function(){
                var RecordID = $(this).attr('RecordID');
                var data = {RecordID : RecordID, Status : 1};
                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Activate Record',
                    message: 'Are you sure about that?',
                    position: 'center',
                    buttons: [
                        ['<button fdprocessedid="4v4adk"><b>YES</b></button>', function (instance, toast) {
                            CallAjax(data,3,'update_user_status');
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
            $(".btn_Delete_Record").on("click",function(){
                var RecordID = $(this).attr('RecordID');
                var data = {RecordID : RecordID, Status : 3};
                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Activate Record',
                    message: 'Are you sure about that?',
                    position: 'center',
                    buttons: [
                        ['<button fdprocessedid="4v4adk"><b>YES</b></button>', function (instance, toast) {
                            CallAjax(data,4,'update_user_status');
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
                            Message(2,'Vendor Successfully deactivated');
                            setTimeout(function() { location.reload();}, 1000);
                        break;
                        case 2:
                            Message(2,'Vendor Successfully activated');
                            setTimeout(function() { location.reload();}, 1000);
                        break;
                        case 3:
                            Message(2,'Vendor Successfully confirmed');
                            setTimeout(function() { location.reload();}, 1000);
                        break;
                        case 4:
                            Message(2,'Vendor Successfully deleted');
                            setTimeout(function() { location.reload();}, 1000);
                        break;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('error: ' + textStatus + ': ' + errorThrown);
                }
            });
        }
    </script>