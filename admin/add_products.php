<?php include '../components/connect.php';
if (isset($_COOKIE['seller_id'])) {
    $seller_id=$_COOKIE['seller_id'];}
else{
    $seller_id='';
    header('location:loging.php');}
    
if (isset($_post['publish'])){
    $id=unique_id();
    $name=$_POST['name'];
    $name=filter_var($name,FILTER_SANITIZE_STRING);

    $price=$_POST['price'];
    $price=filter_var($price,FILTER_SANITIZE_STRING);

    $description=$_POST['description'];
    $description=filter_var($description,FILTER_SANITIZE_STRING);

    $stock=$_POST['stock'];
    $stock=filter_var($stock,FILTER_SANITIZE_STRING);
    $status='active';
    $image=$_FILES['image']['name'];
    $image=filter_var($image,FILTER_SANITIZE_STRING);
    $img_size=$_FILES['image']['size'];
    $img_tmp_name=$_FILES['image']['tmp_name'];
    $image_folder='../uploaded_files/'.$image;
    $select_image=$conn->prepare("SELECT * FROM products WHERE image=? AND seller_id=?");
    $select_image->execute([$image,$seller_id]);

    if (isset($image)){
        if($select_image->rowCount()>0){
            $warning_msg[]='image name repeated';

        }
        elseif($img_size>20000000){
            $warning_msg[]='image size is too large';
        }
        else{
            move_uploaded_file($img_tmp_name,$image_folder);
        }
    }else{
        $image='';
    }
    if($select_image->rowCount() >0 AND $image!=''){
        $warning_msg[]='image name repeated';
    }
    else{
        $insert_product=$conn->prepare("INSERT INTO products(id,seller_id,name,price,image,stock,product_detail,status) VALUES(?,?,?,?,?,?,?,?)");
        $insert_product->execute([$id,$seller_id,$name,$price,$image,$stock,$description,$status]);
        $success_msg[]='product added successfully';
        if ($insert_product->errorCode() !== '00000') {
            print_r($insert_product->errorInfo());
        }
    }
}

if (isset($_POST['draft'])){
    $id=unique_id();
    $name=$_POST['name'];
    $name=filter_var($name,FILTER_SANITIZE_STRING);

    $price=$_POST['price'];
    $price=filter_var($price,FILTER_SANITIZE_STRING);

    $description=$_POST['description'];
    $description=filter_var($description,FILTER_SANITIZE_STRING);

    $stock=$_POST['stock'];
    $stock=filter_var($stock,FILTER_SANITIZE_STRING);
    $status='deactive';
    $image=$_FILES['image']['name'];
    $image=filter_var($image,FILTER_SANITIZE_STRING);
    $img_size=$_FILES['image']['size'];
    $img_tmp_name=$_FILES['image']['tmp_name'];
    $image_folder='../uploaded_files/'.$image;
    $select_image=$conn->prepare("SELECT * FROM products WHERE image=? AND seller_id=?");
    $select_image->execute([$image,$seller_id]);

    if (isset($image)){
        if($select_image->rowCount()>0){
            $warning_msg[]='image name repeated';

        }
        elseif($img_size>20000000){
            $warning_msg[]='image size is too large';
        }
        else{
            move_uploaded_file($img_tmp_name,$image_folder);
        }
    }else{
        $image='';
    }
    if($select_image->rowCount() >0 AND $image!=''){
        $warning_msg[]='image name repeated';
    }
    else{
        $insert_product=$conn->prepare("INSERT INTO products(id,seller_id,name,price,image,stock,product_detail,status) VALUES(?,?,?,?,?,?,?,?)");
        $insert_product->execute([$id,$seller_id,$name,$price,$image,$stock,$description,$status]);
        $success_msg[]='product saved as draft';
    }
}
 


?>


<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Sky Summer Add products page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="post-editor">
            <div class="heading">
                <h1>Add products</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="register">
                    <div class="input-field">
                        <p>product name <span>*</span></p>
                        <input type="text" name="name" maxlength="100" placeholder="Add product name" class="box" required>
                    </div>
                    <div class="input-field">
                        <p>product price <span>*</span></p>
                        <input type="number" name="price" placeholder="Add product price" class="box" required>
                    </div>
                    <div class="input-field">
                        <p>product detail <span>*</span></p>
                        <textarea name="description" maxlength="1000" class="box" placeholder="Add product detail" required ></textarea>
                    </div>
                    <div class="input-field">
                        <p>product stock <span>*</span></p>
                        <input type="number" name="stock" class="box" maxlength="10" min="0" max="99999999" placeholder="Add product stock" required>
                    </div>
                    <div class="input-field">
                        <p>product image <span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box" required>
                    </div>
                    <div class="flex-btn">
                        <input type="submit" name="publish" value="Add product" class="btn">
                        <input type="submit" name="draft" value="save as draft" class="btn">

                    </div>
                    
                    


                </form>
                        
                    
            </div>
           


        </section>

    </div>














<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>
<?php include '../components/alert.php'; ?>
</body>
</html>