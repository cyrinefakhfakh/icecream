<?php
    include 'components/connect.php';
    if(isset($_COOKIE['id'])){
        $id=$_COOKIE['id'];
    }
    else{
        $id='';
        
    }

    

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $email=filter_var($email, FILTER_SANITIZE_EMAIL);

        $pass = $_POST['pass'];
        $pass =filter_var($pass, FILTER_SANITIZE_STRING);

        $select_seller=$conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
        $select_seller->execute([$email,$pass]);
        $row=$select_seller->fetch(PDO::FETCH_ASSOC);
        if($select_seller->rowCount()>0){
                setcookie('id',$row['id'],time()+60*60*24*30,'/');
                header('location:home.php');
                $success_msg[]='login successful';

        }else{
                $warning_msg[]='invalid login details';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login page</title>
        <link rel="stylesheet" type="text/css" href="css/user_style.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>
        <?php include 'components/user_header.php'; ?>
        
                <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="login">
                        <h3>login now</h3>
                        <div class="input-field">
                                <p>your email<span>*</span></p>
                                <input type="email" name="email" placeholder="enter your email" required class="box">
                        </div>


                        <div class="input-field">
                                <p>your password<span>*</span></p>
                                 <input type="password" name="pass" placeholder="enter your password" required class="box">
                        </div>
                        
                                     
                         <p class="link">Do not have an account? <a href="register.php">register now</a></p>
                         <input type="submit" name="submit" class="btn" value="login now">
                                
                </form>

                </div>
                                








































<script src="js/user_script.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/footer.php'; ?>   
<?php include 'components/alert.php'; ?> 
</body>
</html>