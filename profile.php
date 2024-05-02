<?php
    include 'components/connect.php';
    if(isset($_COOKIE['id'])){
        $id=$_COOKIE['id'];
    }
    else{
        $id='location:login.php';
        
    }
    $select_orders=$conn->prepare("SELECT * FROM orders WHERE id=?");
    $select_orders->execute([$id]);
    $total_orders=$select_orders->rowCount();
    $select_message=$conn->prepare("SELECT * FROM message WHERE id=?");
    $select_message->execute([$id]);
    $total_message=$select_message->rowCount();

   ?> 

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile page</title>
        <link rel="stylesheet" type="text/css" href="css/user_style.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>
        <?php include 'components/user_header.php'; ?>
        <div class="banner">
            <div class="detail">
                <h1>Profile</h1>
                <p>Here you can view and edit your profile</p>
                <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>Profile</span>
            </div>
        </div>
        <section class="profile">
            <div class="heading">
                <h1>Profile</h1>
                <img src="image/separator-img.png" >
            </div>
            <div class="detail">
                <div class="user">
                    <img src="uploaded_files/<?= $fetch_profile['image'] ?>" >
                    <h3><?= $fetch_profile['name'] ?></h3>
                    <p><?= $fetch_profile['email'] ?></p>
                    <a href="update.php" class="btn">Edit profile</a>
                </div>
                <div class="box-container">
                    <div class="box">
                        <div class="flex">
                            <i class="bx bxs-folder-minus"></i>
                            <h3><?= $total_orders; ?></h3>
                            
                        </div>
                        <a href="orders.php" class="btn">Orders</a>
                    </div>
                    <div class="box">
                        <div class="flex">
                            <i class="bx bxs-chat"></i>
                            <h3><?= $total_message; ?></h3>
                        </div>
                        <a href="messages.php" class="btn">Messages</a>
                    </div>
                </div>
            </div>

        </section>
        
                    








































<script src="js/user_script.js"></script>
<?php include 'components/alert.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/footer.php'; ?>    
</body>
</html>