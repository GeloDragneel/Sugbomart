<?php
    require("connection/db.php");
    session_start();
    $UserID = 0;
    if(isset($_SESSION['UserID'])){
        $UserID = $_SESSION['UserID'];
    }
    if(isset($_GET['action'])){
        switch($_GET['action']){
            case 'register':
                $FirstName = $_POST['FirstName'];
                $LastName = $_POST['LastName'];
                $ShopName = $_POST['ShopName'];
                $BusinessPermit = $_POST['BusinessPermit'];
                $PhoneNumber = $_POST['PhoneNumber'];
                $Email = $_POST['Email'];
                $Password = md5($_POST['Password']);
                $UserType = $_POST['UserType'];
                $Status = $_POST['Status'];
                $OTP = rand(100000,999999);
                $query = "INSERT INTO `user`(FirstName,LastName,ShopName,BusinessPermit,PhoneNumber,Email,Password,UserType,OTP,Status)
                VALUES('$FirstName','$LastName','$ShopName','$BusinessPermit','$PhoneNumber','$Email','$Password','$UserType',$OTP,$Status)";
                if ($result = $mysqli->query($query)) {
                    echo json_encode(array(
                        'Result' => 1,
                        'Code' => $OTP,
                        'FirstName' => $FirstName,
                        'Email' => $Email
                    ));
                }
                else{
                    echo json_encode(array('Result' => 0));
                }
            break;
            case 'login':
                $resultArray = array();
                $LoginUser = $_POST['LoginUser'];
                $LoginPassword = md5($_POST['LoginPassword']);
                $UserType = $_POST['UserType'];
                $query = "SELECT * FROM user WHERE Email = '$LoginUser' AND Password = '$LoginPassword' AND UserType IN (0,$UserType) AND IsValidate = 1";
                if ($result = $mysqli->query($query)) {
                    if ($result->num_rows > 0)	{
                        $row = $result->fetch_array();
                        if($row['Status'] == 0 && $row['UserType'] != "0"){
                            $resultArray = array(
                                "Result" => "Pending"
                            );
                        }
                        else if($row['Status'] == 2 && $row['UserType'] != "0"){
                            $resultArray = array(
                                "Result" => "Deactivated"
                            );
                        }
                        else if($row['Status'] == 3 && $row['UserType'] != "0"){
                            $resultArray = array(
                                "Result" => "Declined"
                            );
                        }
                        else{
                            $_SESSION['UserID'] = $row['ID'];
                            $_SESSION['Firstname'] = $row['FirstName'];
                            $_SESSION['Lastname'] = $row['LastName'];
                            $_SESSION['EmailAddress'] = $row['Email'];
                            $_SESSION['UserType'] = $row['UserType'];
                            $resultArray = array(
                                "Result" => "Success",
                                "UserType"  => $row['UserType']
                            );
                        }
                    }
                    else{
                        $resultArray = array(
                            "Result" => "Error"
                        );
                    }
                }
                echo json_encode($resultArray);
            break;
            case 'verify_code':

                $Email = $_POST['email_address'];
                $OTP = $_POST['verification_code'];

                $query = "SELECT COUNT(*) as cnt,ID,COALESCE(Email,'') AS Email,COALESCE(`Password`,'') AS Password,COALESCE(`IsValidate`,0) AS IsValidate FROM `user` WHERE Email = '$Email' AND OTP = '$OTP'";
                $rowCount = $mysqli->query($query)->fetch_array();

                if($rowCount['cnt'] > 0){
                    if($rowCount['IsValidate'] == 1){
                        echo json_encode(array('Result' => 'Exists'));
                    }
                    else{
                        $query = "UPDATE user SET `IsValidate` = 1 WHERE ID = " . $rowCount['ID'];
                        if ($result = $mysqli->query($query)) {

                            $resultArray = array();
                            $LoginUser = $rowCount['Email'];
                            $LoginPassword = $rowCount['Password'];

                            $query = "SELECT * FROM user WHERE Email = '$LoginUser' AND Password = '$LoginPassword'";

                            if ($result = $mysqli->query($query)) {
                                if ($result->num_rows > 0)	{
                                    $row = $result->fetch_array();
                                    $_SESSION['UserID'] = $row['ID'];
                                    $_SESSION['Firstname'] = $row['FirstName'];
                                    $_SESSION['Lastname'] = $row['LastName'];
                                    $_SESSION['EmailAddress'] = $row['Email'];
                                    $_SESSION['UserType'] = $row['UserType'];
                                    $resultArray = array(
                                        "Result" => "Success",
                                        "UserType"  => $row['UserType']
                                    );
                                }
                                else{
                                    $resultArray = array(
                                        "Result" => "Error"
                                    );
                                }
                            }
                            echo json_encode($resultArray);
                        }
                    }
                }
                else{echo json_encode(array('Result' => 'NotFound'));}
            break;
            case 'addtocart':
                $ProductID = $_POST['ProductID'];
                $Quantity = $_POST['Quantity'];
                $Price = $_POST['Price'];
                $TotalPrice = $_POST['TotalPrice'];

                $rowCount = $mysqli->query("SELECT COUNT(*) as cnt FROM cart WHERE Status = 0 AND UserID = $UserID AND ProductID = $ProductID")->fetch_array();
                $countLenAddress = $mysqli->query("SELECT CHAR_LENGTH(Address) AS cnt FROM `user` WHERE ID = $UserID")->fetch_array();
                if($countLenAddress['cnt'] > 5){
                    if($rowCount['cnt'] > 0){
                        echo json_encode(array('Result' => 1));
                    }
                    else{
                        $query = "INSERT INTO `cart`(ProductID,Quantity,Price,TotalPrice,UserID)
                        VALUES('$ProductID','$Quantity','$Price','$TotalPrice','$UserID')";
                        if ($result = $mysqli->query($query)) {
                            echo json_encode(array('Result' => 1));
                        }
                        else{
                            echo json_encode(array('Result' => 0));
                        }
                    }
                }
                else{echo json_encode(array('Result' => 2));}
            break;
            case 'wishlist':
                $ProductID = $_POST['ProductID'];
                $Quantity = $_POST['Quantity'];
                $Price = $_POST['Price'];
                $TotalPrice = $_POST['TotalPrice'];

                $query0 = "DELETE FROM wishlist WHERE ProductID = $ProductID AND UserID = $UserID";
                $mysqli->query($query0);

                $query = "INSERT INTO `wishlist`(ProductID,Quantity,Price,TotalPrice,UserID)
                VALUES('$ProductID','$Quantity','$Price','$TotalPrice','$UserID')";
                if ($result = $mysqli->query($query)) {
                    echo json_encode(array('Result' => 1));
                }
                else{
                    echo json_encode(array('Result' => 0));
                }
            break;
            case 'update_cart':
                $newArray = $_POST['newArray'];
                $return = 0;
                foreach($newArray as $list){
                    $Quantity = $list['Quantity'];
                    $TotalPrice = $list['TotalPrice'];
                    $CartID = $list['CartID'];
                    $query = "UPDATE cart SET Quantity = $Quantity, TotalPrice = $TotalPrice WHERE ID = $CartID";
                    if ($result = $mysqli->query($query)) {
                        $return = 1;
                    }
                    else{
                        $return = 0;
                    }
                }
                echo json_encode(array('Result' => $return));
            break;
            case 'delete_cart':
                $CartID = $_POST['CartID'];
                $query = "DELETE FROM cart WHERE ID = $CartID";
                if ($result = $mysqli->query($query)) {
                    echo json_encode(array('Result' => 1));
                }
                else{
                    echo json_encode(array('Result' => 0));
                }
            break;
            case 'proceed_cart':
                $newArray = $_POST['newArray'];
                $return = 0;
                foreach($newArray as $list){
                    $CartID = $list['CartID'];
                    $query = "UPDATE cart SET Status = 0 WHERE ID = $CartID";
                    if ($result = $mysqli->query($query)) {
                        $return = 1;
                    }
                    else{
                        $return = 0;
                    }
                }
                echo json_encode(array('Result' => $return));
            break;
            case 'place_order':
                $newArray = $_POST['newArray'];
                $return = 0;
                foreach($newArray as $list){
                    $CartID = $list['CartID'];
                    $query = "UPDATE cart SET Status = 1 WHERE ID = $CartID";
                    if ($result = $mysqli->query($query)) {

                        $query1 = "INSERT INTO `order`(CartID) VALUES ($CartID)";
                        $mysqli->query($query1);

                        $return = 1;
                    }
                    else{
                        $return = 0;
                    }
                }
                echo json_encode(array('Result' => $return));
            break;
            case 'save_shop':
                $ID = $_POST['ID'];
                $StoreName = $_POST['StoreName'];
                $StoreAddress = $_POST['StoreAddress'];
                if($ID == 0){
                    $query = "INSERT INTO `store`(StoreName,StoreAddress,UserID)
                    VALUES('$StoreName','$StoreAddress',$UserID)";
                    if ($result = $mysqli->query($query)) {
                        $lastID = $mysqli->insert_id;
                        echo json_encode(array('Result' => $lastID));
                    }
                    else{
                        echo json_encode(array('Result' => 0));
                    }
                }
                else{
                    $query = "UPDATE store SET StoreName = '$StoreName',StoreAddress = '$StoreAddress' WHERE ID = $ID";
                    if ($result = $mysqli->query($query)) {
                        echo json_encode(array('Result' => $ID));
                    }
                    else{
                        echo json_encode(array('Result' => 0));
                    }
                }
            break;
            case 'upload_shop_img':
                $resArray = array();
                $ID = $_POST['ID'];
                $files = $_FILES['file']['name'];
                // Count the number of uploaded files in array
                $tmpFilePath = $_FILES['file']['tmp_name'];
                //A file path needs to be present
                if ($tmpFilePath != ""){
                    //Setup our new file path
                    $filename = 'feature-' . $ID.'.webp';
                    $newFilePath = "img/store/".$filename;
                    //File is uploaded to temp dir
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        array_push($resArray,$newFilePath);
                    }
                }
                echo json_encode($resArray);
            break;
            case 'upload_shop_img2':
                $resArray = array();
                $ID = $_POST['ID'];
                $files = $_FILES['file']['name'];
                // Count the number of uploaded files in array
                $tmpFilePath = $_FILES['file']['tmp_name'];
                //A file path needs to be present
                if ($tmpFilePath != ""){
                    //Setup our new file path
                    $filename = 'feature-' . $ID.'.webp';
                    $newFilePath = "img/business_permit/".$filename;
                    //File is uploaded to temp dir
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        array_push($resArray,$newFilePath);
                    }
                }
                echo json_encode($resArray);
            break;
            case 'upload_shop_img3':
                $resArray = array();
                $ID = $_POST['ID'];
                $files = $_FILES['file']['name'];
                // Count the number of uploaded files in array
                $tmpFilePath = $_FILES['file']['tmp_name'];
                //A file path needs to be present
                if ($tmpFilePath != ""){
                    //Setup our new file path
                    $filename = 'feature-' . $ID.'.webp';
                    $newFilePath = "img/sanitary_permit/".$filename;
                    //File is uploaded to temp dir
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        array_push($resArray,$newFilePath);
                    }
                }
                echo json_encode($resArray);
            break;
            case 'delete_shop':
                $RecordID = $_POST['RecordID'];
                $query = "DELETE FROM store WHERE ID = $RecordID";
                if ($result = $mysqli->query($query)) {
                    echo json_encode(array('Result' => 1));
                }
                else{
                    echo json_encode(array('Result' => 0));
                }
            break;
            case 'delete_product':
                $RecordID = $_POST['RecordID'];
                $query = "DELETE FROM products WHERE ID = $RecordID";
                if ($result = $mysqli->query($query)) {
                    echo json_encode(array('Result' => 1));
                }
                else{
                    echo json_encode(array('Result' => 0));
                }
            break;
            case 'save_product':
                $ID = $_POST['ID'];
                $ProductName = $_POST['ProductName'];
                $ProductDesc = $_POST['ProductDesc'];
                $ProductInfo = $_POST['ProductInfo'];
                $Price = $_POST['Price'];
                $DiscountedPrice = $_POST['DiscountedPrice'];
                $Quantity = $_POST['Quantity'];
                $StoreID = $_POST['StoreID'];
                $ExpiryDate = $_POST['ExpiryDate'];
                $Unit = $_POST['Unit'];
                $CategoryID = $_POST['CategoryID'];
                if($ID == 0){
                    $query = "INSERT INTO `products`(ProductName,ProductDesc,ProductInfo,Price,DiscountedPrice,Quantity,StoreID,ExpiryDate,Unit,CategoryID)
                    VALUES('$ProductName','$ProductDesc','$ProductInfo',$Price,'$DiscountedPrice','$Quantity','$StoreID','$ExpiryDate','$Unit','$CategoryID')";
                    if ($result = $mysqli->query($query)) {
                        $lastID = $mysqli->insert_id;
                        echo json_encode(array('Result' => $lastID));
                    }
                    else{
                        echo json_encode(array('Result' => 0));
                    }
                }
                else{
                    $query = "
                    UPDATE products SET 
                        ProductName = '$ProductName',
                        ProductDesc = '$ProductDesc',
                        ProductInfo = '$ProductInfo',
                        Price = '$Price',
                        DiscountedPrice = '$DiscountedPrice',
                        Quantity = '$Quantity',
                        ExpiryDate = '$ExpiryDate',
                        CategoryID = '$CategoryID',
                        StoreID = '$StoreID'
                    WHERE ID = $ID";
                    if ($result = $mysqli->query($query)) {
                        echo json_encode(array('Result' => $ID));
                    }
                    else{
                        echo json_encode(array('Result' => 0));
                    }
                }
            break;
            case 'upload_product_img':
                // Count total files
                $countfiles = count($_FILES['filesImages']['name']);
                // Upload Location
                $upload_location = "img/product/";
                $ProductID = $_POST['ProductID'];
                // To store uploaded files path
                $files_arr = array();
                // Loop all files
                for($index = 0;$index < $countfiles;$index++){
                    if(isset($_FILES['filesImages']['name'][$index]) && $_FILES['filesImages']['name'][$index] != ''){
                        $filename = $ProductID . '_' . microtime(TRUE) . '.webp';
                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        $path = $upload_location.$filename;
                        if(move_uploaded_file($_FILES['filesImages']['tmp_name'][$index],$path)){
                            $files_arr[] = $filename;
                        }
                    }
                }
                echo json_encode($files_arr);
            break;
            case 'unlink_image':
                $Link = $_POST['Link'];
                unlink($Link);
                echo json_encode('Success');
            break;
            case 'save_shopper_info':
                $ID = $_POST['ID'];
                $FirstName = $_POST['FirstName'];
                $LastName = $_POST['LastName'];
                $Address = $_POST['Address'];
                $Address2 = $_POST['Address2'];
                $Email = $_POST['Email'];
                $PhoneNumber = $_POST['PhoneNumber'];
                $query = "
                UPDATE user SET 
                    FirstName = '$FirstName',
                    LastName = '$LastName',
                    Address = '$Address',
                    Address2 = '$Address2',
                    Email = '$Email',
                    PhoneNumber = '$PhoneNumber'
                WHERE ID = $ID";
                if ($result = $mysqli->query($query)) {
                    $return = 1;
                }
                else{
                    $return = 0;
                }
                echo json_encode(array('Result' => $return));
            break;
            case 'update_user_status':
                $RecordID = $_POST['RecordID'];
                $Status = $_POST['Status'];
                $query = "UPDATE user SET Status = '$Status' WHERE ID = $RecordID";
                if ($result = $mysqli->query($query)) {
                    $return = 1;
                }
                else{
                    $return = 0;
                }
                echo json_encode(array('Result' => $return));
            break;
            case 'forgot_password':
                $Email = $_POST['Email'];
                $Password = md5('123456');
                $query = "UPDATE user SET Password = '$Password' WHERE Email = '$Email' AND IsValidate = 1";
                if ($result = $mysqli->query($query)) {
                    $return = 1;
                }
                else{
                    $return = 0;
                }
                echo json_encode(array(
                    'Result' => $return,
                    'Email' => $Email,
                ));
            break;
        }
    }
?>