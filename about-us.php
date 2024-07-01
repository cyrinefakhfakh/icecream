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
    <title>About-us page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>About us</h1>
            <p>Crafted with passion and creativity, each scoop is a celebration<br> of quality ingredients
                 and expert craftsmanship. From classic<br> favorites like velvety vanilla to inventive twists such as salted caramel<br> swirl, every spoonful promises a delightful journey for your taste buds.</p>
            <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>About us</span>
        </div>
    </div>
    <div class="chef">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>Alex Doe</span>
                    <h1>Masterchef</h1>
                    <img src="image/separator-img.png" >
                </div>
                <p>Alex Doe is a culinary virtuoso, renowned for his innovative 
                    approach to gastronomy and his unwavering commitment to 
                    excellence in the kitchen. With a career spanning over two 
                    decades, Chef Doe has carved out a name 
                     himself as a trailblazer in the culinary world.</p>
                <div class="flex-btn">
                        <a href="" class="btn">Explore our menu</a>
                        <a href="menu.php" class="btn">Visit our shop</a>
                </div>
            </div>
            <div class="box">
                <img src="image/ceaf.png" class="img">
            </div>
        </div>
    </div>
   
  <?php include 'components/footer.php'; ?>



























<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/user_script.js"></script>
<?php include 'components/alert.php'; ?>
    
</body>
</html>
