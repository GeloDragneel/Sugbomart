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
                        <h2>My Orders</h2>
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
                <table class="table table-bordered" id="table_MyOrder">
                    <thead>
                        <tr>
                            <th>Order Date</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 0;
                            $SubTotal = 0;
                            require("connection/db.php");
                            $query = "
                            SELECT 
                                A.ID,
                                A.OrderDate,
                                C.ProductName,
                                B.Quantity,
                                B.Price,
                                B.TotalPrice,
                                A.OrderStatusID
                            FROM `order` A
                            INNER JOIN cart B ON B.ID = A.CartID
                            INNER JOIN products C ON C.ID = B.ProductID
                            WHERE B.UserID = $UserID
                            ORDER BY A.ID DESC" ;
                            if ($result = $mysqli->query($query)) {
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_array()){
                                        $Status = '';
                                        if($row['OrderStatusID'] == 0){
                                            $Status = 'Pending';
                                        }
                                        $mysqldate = $row['OrderDate'];
                                        $phpdate = strtotime( $mysqldate );
                                        $mysqldate = date( 'M d Y - h:i:s a', $phpdate );
                                        echo '
                                        <tr>
                                            <td>'.$mysqldate.'</td>
                                            <td>'.$row['ProductName'].'</td>
                                            <td>'.$row['Quantity'].'</td>
                                            <td>'.$row['Price'].'</td>
                                            <td>'.$row['TotalPrice'].'</td>
                                            <td>'.$Status.'</td>
                                            <td class="text-center hand-cursor"><a class="text-danger"><i class="fa fa-times"></i></a></td>
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
        })
    </script>