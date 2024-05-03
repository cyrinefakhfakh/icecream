<?php
    include 'components/connect.php';


    if(isset($_COOKIE['id'])){
        $id=$_COOKIE['id'];
    } else {
        $id='';
    }

    if (isset($_POST['submit'])) {
        $select_seller=$conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
        $select_seller->execute([$id]);
    
        $fetch_seller=$select_seller->fetch(PDO::FETCH_ASSOC);
    
        $prev_pass=$fetch_seller['password'];
        $prev_image=$fetch_seller['image'];
    
        $name=$_POST['name'];
        $name= filter_var($name,FILTER_SANITIZE_STRING);
        $email=$_POST['email'];
        $email= filter_var($email,FILTER_SANITIZE_EMAIL);
    
        
            if (!empty($name)) {
                $update_name=$conn->prepare("UPDATE users SET name=? WHERE id=?");
                $update_name->execute([$name,$id]);
                $success_msg='name updated successfully';
               
            }
            if (!empty($email)) {
                $select_email=$conn->prepare("SELECT * FROM users WHERE id=? and email=?");
                $select_email->execute([$email,$id]);
                $email_domain = strtolower(substr(strrchr($email, "@"), 1)); // Extract domain from email
            if (!in_array($email_domain, ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'aol.com', 'protonmail.com', 'zoho.com', 'icloud.com', 'mail.com', 'yandex.com', 'gmx.com', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'gmail.com'])) {
                $warning_msg[] = 'Email must have a valid Gmail domain';
            } else {
                if ($select_email->rowCount()>0) {
    
                    $error_msg[]='email already exist';
                }
                else{
                    $select_email=$conn->prepare("UPDATE users SET email=? WHERE id=?");
                    $select_email->execute([$email,$id]);
                    $success_msg[]='Email updated successfully';
                }
               
            }}
            $image=$_FILES['image']['name'];
            $image= filter_var($image,FILTER_SANITIZE_STRING);
            $ext=pathinfo($image,PATHINFO_EXTENSION);
            $rename=uniqid().'.'.$ext;
            $image_size=$_FILES['image']['size'];
            $image_tmp_name=$_FILES['image']['tmp_name'];
            $image_folder='../uploaded_files/'.$rename;
            if (!empty($image)) {
                if ($image_size>5000000) {
                    $error_msg[]='image size is too large';
                }
                else{
                    $update_image=$conn->prepare("UPDATE users SET image=? WHERE id=?");
                    $update_image->execute([$rename,$id]);
                    move_uploaded_file($image_tmp_name,$image_folder);
                    if ($prev_image!='default.jpg') {
                        unlink('../uploaded_files/'.$prev_image);
                    }
                    $success_msg[]='image updated successfully';
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
                            $update_pass=$conn->prepare("UPDATE users SET password=? WHERE id=?");
                            $update_pass->execute([sha1($new_pass),$id]);
                            $success_msg[]='password updated successfully';
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
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update profile page</title>
        <link rel="stylesheet" type="text/css" href="css/user_style.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>
        <?php include 'components/user_header.php'; ?>
        
        <section class="form-container">
            <div class="heading">
                <h1>Update profile </h1>
                <img src="image/separator-img.png">
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="img-box">
                    <img src="uploaded_files/<?= $fetch_profile['image']; ?>"  >  
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
                                








































<script src="js/user_script.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/footer.php'; ?>  
<?php include 'components/alert.php'; ?>  
</body>
</html>