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
                        <h2>Store List</h2>
                        <div class="breadcrumb__option">
                            <a href="index">Home</a>
                            <span>Store</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="contact-form spad">
        <div class="container">
            <div class="row featured__filter">
            <?php
                require("connection/db.php");
                $query = "SELECT * FROM `store`";
                if ($result = $mysqli->query($query)) {
                    while($row = $result->fetch_array()){
                        $img = 'img/store/feature-' . $row['ID'] . '.webp?v=' . date('Ymdhis');
                        echo '<a href="shop-grid?storeid='.$row['ID'].'"><div class="col-lg-3 col-md-4 col-sm-6 mix">
                                <div class="featured__item">
                                    <div class="featured__item__pic set-bg" data-setbg="'.$img.'"></div>
                                    <div class="featured__item__text">
                                        <h6><a href="shop-grid?storeid='.$row['ID'].'">'.$row['StoreName'].'</a></h6>
                                        <h5>'.$row['StoreAddress'].'</h5>
                                    </div>
                                </div>
                            </div>
                        </a>';
                    }
                }
            ?>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>