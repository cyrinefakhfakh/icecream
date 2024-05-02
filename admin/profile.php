<?php include '../components/connect.php';
if (isset($_COOKIE['seller_id'])) {
    $seller_id=$_COOKIE['seller_id'];}
else{
    $seller_id='';
    header('location:loging.php');}
$select_products=$conn->prepare("SELECT * FROM products WHERE id=?");
$select_products->execute([$seller_id]);
$total_products=$select_products->rowCount();

$select_orders=$conn->prepare("SELECT * FROM orders WHERE id=?");
$select_orders->execute([$seller_id]);
$total_orders=$select_orders->rowCount();
 

?>


<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Seller profile</title>
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
    </head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="seller-profile">
            <div class="heading">
                <h1>profile details</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="details">
                <div class="seller">
                    <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" >
                    <h3 class="name"><?= $fetch_profile['name']; ?></h3>
                    <span>Seller</span>
                    <a href="update.php" class="btn">update profile</a>
                    <div class="flex">
                        <div class="box">
                            <span><?= $total_products; ?></span>
                            <p>Total products</p>
                            <a href="view_products.php" class="btn">View products</a>
                        </div>
                        <div class="box">
                            <span><?= $total_orders; ?></span>
                            <p>Total orders place</p>
                            <a href="admin_order.php" class="btn">View orders</a>
                        </div>

                    </div>
                </div>
            </div>

            

            


        </section>

</div>






<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>
<?php include '../components/alert.php'; ?>
</body>
</html>