<?php include '../components/connect.php';
if (isset($_COOKIE['seller_id'])) {
    $seller_id=$_COOKIE['seller_id'];}
else{
    $seller_id='';
    header('location:loging.php');}
    

 

?>


<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Blue Sky Summer Show Products page</title>
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
    </head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="show-post">
            <div class="heading">
                <h1>Your products</h1>
                <img src="../image/separator-img.png">
            </div>
           <div class="box-container">
            <?php
                $select_products=$conn->prepare("SELECT * FROM products WHERE seller_id=? ");
                $select_products->execute([$seller_id]);
                if($select_products->rowCount()>0){
                    while($fetch_products=$select_products->fetch(PDO::FETCH_ASSOC)){
                        $product_id=$fetch_products['id'];
                        $product_name=$fetch_products['name'];
                        $product_price=$fetch_products['price'];
                        $product_image=$fetch_products['image'];
                        $product_stock=$fetch_products['stock'];
                        $product_detail=$fetch_products['product_detail'];
                        $product_status=$fetch_products['status'];  
                    

            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <?php 
                if($fetch_products['image']!=''){
                ?><img src="../uploaded_files/<?= $fetch_products['image']; ?>" >
                <?php}?>

            </form>
            <?php 
                    }else{
                        echo'
                        <div class="empty">
                            <p>No products added yet ! <br><a href="add_products.php" class="btn" style="margin-top:1.5rem;">Add products</a></p>
                        </div>
                        
                        ';
                    }
?>
           </div>


        </section>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>
<?php include '../components/alert.php'; ?>
</body>
</html>