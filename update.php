<?php
include 'components/connect.php';


if(isset($_COOKIE['id'])){
    $id=$_COOKIE['id'];
} else {
    $id='';
}

if (isset($_POST['submit'])) {
    $select_user = $conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
    $select_user->execute([$id]);
    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

    $prev_pass = $fetch_user['password'];
    $prev_image = $fetch_user['image'];

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Validate email domain
// Validate email domain
$email_domain = strtolower(substr(strrchr($email, "@"), 1)); // Extract domain from email
$allowed_domains = ['gmail.com', 'googlemail.com']; // Allowed Gmail domains

if (!in_array($email_domain, $allowed_domains)) {
    $warning_msg[] = 'Email must have a valid Gmail domain';
} else {
    if (!empty($name)) {
        $update_name = $conn->prepare("UPDATE users SET name=? WHERE id=?");
        $update_name->execute([$name, $id]);
        $success_msg = 'Name updated successfully';
    }

    if (!empty($email)) {
        $select_email = $conn->prepare("SELECT COUNT(*) FROM users WHERE email=? AND id<>?");
        $select_email->execute([$email, $id]);
        $email_count = $select_email->fetchColumn();

        if ($email_count > 0) {
            $warning_msg[] = 'Email already exists';
        } else {
            $update_email = $conn->prepare("UPDATE users SET email=? WHERE id=?");
            $update_email->execute([$email, $id]);
            $success_msg = 'Email updated successfully';
        }
    }
}

    // Image upload logic
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image'];
        $image_folder = 'uploaded_files/';
        $new_image_name = uniqid() . '_' . $image['name'];
        move_uploaded_file($image['tmp_name'], $image_folder . $new_image_name);
        
        $update_image = $conn->prepare("UPDATE users SET image=? WHERE id=?");
        $update_image->execute([$new_image_name, $id]);
        $success_msg = 'Image updated successfully';
    }

    // Password update logic
    $old_password = filter_var($_POST['old_password'], FILTER_SANITIZE_STRING);
    $new_pass = filter_var($_POST['new_pass'], FILTER_SANITIZE_STRING);
    $cpass = sha1(filter_var($_POST['cpass'], FILTER_SANITIZE_STRING));

    if (!empty($old_password)) {
        if (sha1($old_password) == $prev_pass) {
            if (!empty($new_pass)) {
                if ($new_pass == $cpass) {
                    $update_pass = $conn->prepare("UPDATE users SET password=? WHERE id=?");
                    $update_pass->execute([sha1($new_pass), $id]);
                    $success_msg = 'Password updated successfully';
                } else {
                    $warning_msg[] = 'Passwords do not match';
                }
            } else {
                $warning_msg[] = 'New password is required';
            }
        } else {
            $warning_msg[] = 'Old password does not match';
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
<?php include 'components/alert.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/footer.php'; ?>    
</body>
</html>