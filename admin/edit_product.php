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
        <title>Blue Sky Summer registration</title>
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
    </head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="dashboard">
            <div class="heading">
                <h1>Edit product</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">
                <?php
                    $product_id=$_GET['id'];
                    $select_product=$conn->prepare("SELECT * FROM products WHERE id=? AND seller_id=?");
                    $select_product->execute([$product_id, $seller_id]);
                    if ($select_product->rowCount() >0) {
                        while($fetch_product=$select_product->fetch(PDO::FETCH_ASSOC)){
                       
                ?>
                <div class="form-container">
                    <form action="" method="post" encrypte="multipart/form-data" class="register">
                        <input type="hidden" name="old_image" value="<?= $fetch_product['image']; ?>">
                        <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
                        <div class="input_field">
                            <p>product status<span>*</span></p>
                            <select name="status" class="box">
                                <option value="<?= $fetch_product['status']; ?>" selected><?= $fetch_product['status']; ?></option>
                                <option value="active">active</option>
                                <option value="deactive">deactive</option>
                            </select>
                        </div>
                        <div class="input_field">
                            <p>product name<span>*</span></p>
                            <input type="text" name="name" value="<?= $fetch_product['name']; ?>" class="box" >
                        </div>
                        <div class="input_field">
                            <p>product price<span>*</span></p>
                            <input type="number" name="price" value="<?= $fetch_product['price']; ?>" class="box" >
                        </div>
                        <div class="input_field">
                            <p>product description<span>*</span></p>
                            <textarea name="description" class="box"><?= $fetch_product['description']; ?></textarea>
                        </div>
                        <div class="input_field">
                            <p>product stock<span>*</span></p>
                            <input type="number" name="stock" value="<?= $fetch_product['stock']; ?>" class="box" min="0" max="99999" maxlength="10">
                        </div>
                        <div class="input_field">
                            <p>product image<span>*</span></p>
                            <input type="file" name="image" accept="image/*" class="box" >
                            <?php if ($fetch_product['image'] != '') { ?>
                                <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="image" >
                                <div class="flex-btn">
                                    <input type="submit" name="delete_image" class="btn" value="delete image">
                                    <a href="view_product.php" class="btn" style="width:49%; text-aligh:center; height:3rem; margin-top: .7rem">Go back</a>
                                </div>

                              <?php } ?>
                        </div>

                            <div class="flex-btn">
                               <input type="submit" name="update" class="btn" value="update product">
                               <input type="submit" name="delete" class="btn" value="delete product">
                            </div>

                    </form>
                </div>

                <?php
                        }
                    }else{
                        echo '<div class="empty">
                        <p>no product added yet!</p>
                            </div>';
                    
                ?>
                <br><br>
                <div class="flex-btn">
                     <input type="submit" name="update" class="btn" value="update product">
                    <input type="submit" name="delete" class="btn" value="delete product">
                </div>
                <?php } ?>
            </div>

        </section>
    </div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>
<?php include '../components/alert.php'; ?>
</body>
</html>