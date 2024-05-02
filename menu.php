<?php
    include 'components/connect.php';
    if(isset($_COOKIE['id'])){
        $id=$_COOKIE['id'];
    }
    else{
        $id='';
        
    }

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Our shop page</title>
        <link rel="stylesheet" type="text/css" href="css/user_style.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>
        <?php include 'components/user_header.php'; ?>
        <div class="banner">
        <div class="detail">
            <h1>Our shop</h1>
            <p>Crafted with passion and creativity, each scoop is a celebration<br> of quality ingredients
                 and expert craftsmanship. From classic<br> favorites like velvety vanilla to inventive twists such as salted caramel<br> swirl, every spoonful promises a delightful journey for your taste buds.</p>
            <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Our shop</span>
        </div>
    </div>  
    <div class="products">
        <div class="heading">
            <h1>Our latest flavoure</h1>
            <img src="image/separator-img.png" alt="">
        </div>
        <div class="box-container">
            <?php
                $select_products=$conn->prepare("SELECT * FROM products WHERE status=?");
                $select_products->execute(['active']);
                if($select_products->rowCount()>0){
                    while($fetch_products=$select_products->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <form action="" method="post" class="box <?php if($fetch_products['stock'] ==0){echo 'out-of-stock';} ?>">
                            <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image" >
                            <?php if($fetch_products['stock'] >9){ ?>
                                <span class="stock" style="color:green;">In Stock</span>
                            <?php }elseif ($fetch_products['stock']==0) {?>
                                <span class="stock" style="color:red;">Out of stock</span>
                                <?php }else{

                                ?>
                                <span class="stock" style="color:orange;">Hurry ,Low stock</span>
                                <?php } ?>
                                <div class="content">
                                    <img src="image/shape-19.png" alt="" class="shap">
                                    <div class="button">
                                        <div><h3 class="name"><?= $fetch_products['name']; ?></h3></div>
                                        <div>
                                            <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                                            <button type="submit" name="add_to_cart"><i class="bx bx-heart"></i></button>
                                            <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="bx bx-show"></a>

                                        </div>

                                    </div>
                                    <p class="price"><i>$<?= $fetch_products['price']; ?></i></p>
                                    <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                                    <div class="flex-btn">
                                        <a href="chekout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Buy now</a>
                                        <input type="number" name="qty box" value="1" min="1" max="<?= $fetch_products['stock']; ?>" class="quantity">
                                    </div>
                                </div>
                        </form>
                        <?php
                    }
                }else{
                    echo ' <div class="empty"> 
                        <p>No products added yet !</p>
                        </div>';
                
                }
                ?>
        </div>
        


    </div> 








































<script src="js/user_script.js"></script>
<?php include 'components/alert.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/footer.php'; ?>    
</body>
</html>