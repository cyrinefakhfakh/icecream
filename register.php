<?php include 'components/connect.php';
  if(isset($_COOKIE['id'])){
    $id=$_COOKIE['id'];
  }
  else{
    $id='';
    
  }

  if (isset($_POST['submit'])) {
    $id = unique_id();
    $name = $_POST['name'];
    $name =filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email=filter_var($email, FILTER_SANITIZE_EMAIL);

    $pass = $_POST['pass'];
    $pass =filter_var($pass, FILTER_SANITIZE_STRING);

    $cpass = $_POST['cpass'];
    $cpass =filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image =filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);

    $rename = unique_id() . "." . $ext;
    $image_size=$_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_files/' . $rename;
    $select_seller=$conn->prepare("SELECT * FROM users WHERE email=?");
    $select_seller->execute([$email]);
    $email_domain = strtolower(substr(strrchr($email, "@"), 1)); // Extract domain from email
    if (!in_array($email_domain, ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'aol.com', 'protonmail.com', 'zoho.com', 'icloud.com', 'mail.com', 'yandex.com', 'gmx.com', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'mailbox.org', 'tutanota.com', 'disroot.org', 'riseup.net', 'mailbox.org', 'kolabnow.com', 'posteo.de', 'gmail.com'])) {
        $warning_msg[] = 'Email must have a valid Gmail domain';
    } else {if($select_seller->rowCount()>0){
        $warning_msg[]='Email already exists';
    }else{
        if ($pass != $cpass) {
            
            $warning_msg[] = 'Passwords do not match';}
            elseif ($image_size > 1000000) {
                $warning_msg[] = 'Image size is too large';
            } else {
                $insert_seller = $conn->prepare("INSERT INTO users(id,name,email,password,image) VALUES(?,?,?,?,?)");
                $insert_seller->execute([$id, $name, $email, $pass, $rename]);
                move_uploaded_file($image_tmp_name, $image_folder);
                $success_msg[] = 'Registration successful';
            }
        }
    
    }}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    
        <div class="form-container">
       <form action="" method="post" enctype="multipart/form-data" class="register">
            <h3>register now</h3>
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>your name<span>*</span></p>
                        <input type="text" name="name" placeholder="enter your name" required class="box">
                    </div>
                    <div class="input-field">
                        <p>your email<span>*</span></p>
                        <input type="email" name="email" placeholder="enter your email" required class="box">
                    </div>
                </div>

                <div class="col">
                    <div class="input-field">
                        <p>your password<span>*</span></p>
                        <input type="password" name="pass" placeholder="enter your password" required class="box">
                    </div>
                    <div class="input-field">
                        <p>confirm password<span>*</span></p>
                        <input type="password" name="cpass" placeholder="confirm password" required class="box">
                    </div>
                </div>
                </div>
                    <div class="input-field">
                        <p>your profile<span>*</span></p>
                        <input type="file" name="image" accept="image/*" required class="box">
                    </div>
                    <p class="link">already have an account? <a href="login.php">login</a></p>
                    <input type="submit" name="submit" class="btn" value="register now">
                
            </form>

            </div>
                








































<script src="js/user_script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/footer.php'; ?>  
<?php include 'components/alert.php'; ?>  
</body>
</html>
