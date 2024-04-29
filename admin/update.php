<?php include '../components/connect.php';
if (isset($_COOKIE['seller_id'])) {
    $seller_id=$_COOKIE['seller_id'];}
else{
    $seller_id='';
    header('location:loging.php');}
if (isset($_POST['submit'])) {
    $select_seller=$conn->prepare("SELECT * FROM sellers WHERE id=? LIMIT 1");
    $select_seller->execute([$seller_id]);

    $fetch_seller=$select_seller->fetch(PDO::FETCH_ASSOC);

    $prev_pass=$fetch_seller['password'];
    $prev_image=$fetch_seller['image'];

    $name=$_POST['name'];
    $name= filter_var($name,FILTER_SANITIZE_STRING);
    $email=$_POST['email'];
    $email= filter_var($email,FILTER_SANITIZE_EMAIL);

    
        if (!empty($name)) {
            $update_name=$conn->prepare("UPDATE sellers SET name=? WHERE id=?");
            $update_name->execute([$name,$seller_id]);
            $success_msg='name updated successfully';
           
        }
        if (!empty($email)) {
            $select_email=$conn->prepare("SELECT * FROM sellers WHERE id=? and email=?");
            $select_email->execute([$email,$seller_id]);
            if ($update_email->rowCount()>0) {

                $warning_msg[]='email already exist';
            }
            else{
                $update_email=$conn->prepare("UPDATE sellers SET email=? WHERE id=?");
                $update_email->execute([$email,$seller_id]);
                $success_msg='email updated successfully';
            }
           
        }
        $image=$_FILES['image']['name'];
        $image= filter_var($image,FILTER_SANITIZE_STRING);
        $ext=pathinfo($image,PATHINFO_EXTENSION);
        $rename=uniqid().'.'.$ext;
        $image_size=$_FILES['image']['size'];
        $image_tmp_name=$_FILES['image']['tmp_name'];
        $image_folder='../uploaded_files/'.$rename;
        if (!empty($image)) {
            if ($image_size>5000000) {
                $warning_msg[]='image size is too large';
            }
            else{
                $update_image=$conn->prepare("UPDATE sellers SET image=? WHERE id=?");
                $update_image->execute([$rename,$seller_id]);
                move_uploaded_file($image_tmp_name,$image_folder);
                if ($prev_image!='default.jpg') {
                    unlink('../uploaded_files/'.$prev_image);
                }
                $success_msg='image updated successfully';
            }
        }
        $old_password=$_POST['old_password'];
        $old_password= filter_var($old_password,FILTER_SANITIZE_STRING);
        $new_pass=$_POST['new_pass'];
        $new_pass= filter_var($new_pass,FILTER_SANITIZE_STRING);
        $cpass=sha1($_POST['cpass']);
        $cpass= filter_var($cpass,FILTER_SANITIZE_STRING);
        if (!empty($old_password)) {
            if (sha1($old_password)==$prev_pass) {
                if (!empty($new_pass)) {
                    if ($new_pass==$cpass) {
                        $update_pass=$conn->prepare("UPDATE sellers SET password=? WHERE id=?");
                        $update_pass->execute([sha1($new_pass),$seller_id]);
                        $success_msg='password updated successfully';
                    }
                    else{
                        $warning_msg[]='password does not match';
                    }
                }
                else{
                    $warning_msg[]='new password is required';
                }
            }
            else{
                $warning_msg[]='old password does not match';
            }
            
        }
       
    }





 

?>


<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Update profile</title>
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
    </head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="form-container">
            <div class="heading">
                <h1>Update profile </h1>
                <img src="../image/separator-img.png">
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="img-box">
                    <img src="../uploaded_files/<?= $fetch_profile['image']; ?>"  >  
                </div>
                <div class="flex">
                    <div class="col">
                        <div class="input-field">
                            <p>Your Name<span>*</span></p>
                            <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" class="box">
                        </div>
                        <div class="input-field">
                            <p>Your email<span>*</span></p>
                            <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" class="box">
                        </div>
                        <div class="input-field">
                            <p>Update picture<span>*</span></p>
                            <input type="file" name="image" accept="image/*" class="box">
                        </div>
                    </div>
                    <div class="col">

                        <div class="input-field">
                            <p>old password<span>*</span></p>
                            <input type="password" name="old_password" placeholder="Enter Your Old password" class="box">
                        </div>
                        <div class="input-field">
                            <p>New Password<span>*</span></p>
                            <input type="password" name="new_pass" placeholder="Enter your new password " class="box">
                        </div>
                        <div class="input-field">
                            <p>Confirm password<span>*</span></p>
                            <input type="password" name="cpass" placeholder="confirm your password" class="box">
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" value="Update" class="btn">

            </form>
            

            


        </section>

</div>






<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>
<?php include '../components/alert.php'; ?>
</body>
</html>