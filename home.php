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
    <title>Home page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="slider-container">
      <div class="slider">
        <div class="slideBox active">
          <div class="textBox">
            <h1>We pride ourselfs on <br> exeptional flavors</h1>
            <a href="menu.php" class="btn">Shop Now</a>
          </div>
          <div class="imgBox">
            <img src="image/slider.jpg" >
          </div>

        </div>
        <div class="slideBox">
          <div class="textBox">
            <h1>Our ice cream is made <br> with love</h1>
            <a href="menu.php" class="btn">Shop Now</a>
          </div>
          <div class="imgBox">
            <img src="image/slider0.jpg" >
          </div>
        </div>
      </div>
      <ul class="controls">
        <li onclick="nextSlide()" class="next"><i class="bx bx-right-arrow-alt"></i></li>
        <li onclick="nextSlide()" class="prev"><i class="bx bx-left-arrow-alt"></i></li>
      </ul>

    </div>
    <div class="service">
      <div class="box-container">
        <div class="box">
          <div class="icon">
            <div class="icon-box">
              <img src="image/services.png" class="img1">
              <img src="image/services (1).png" class="img2">
            </div>
          </div>
          <div class="detail">
            <h4>Delivery</h4>
            <span>100% secure</span>
          </div>
        </div>

        <div class="box">
          <div class="icon">
            <div class="icon-box">
              <img src="image/services (2).png" class="img1">
              <img src="image/services (3).png" class="img2">
            </div>
          </div>
          <div class="detail">
            <h4>Payment</h4>
            <span>100% secure</span>
          </div>
        </div>

        <div class="box">
          <div class="icon">
            <div class="icon-box">
              <img src="image/services (7).png" class="img1">
              <img src="image/services (8).png" class="img2">
            </div>
          </div>
          <div class="detail">
            <h4>Gift service</h4>
            <span>support gift service</span>
          </div>
        </div>

        <div class="box">
          <div class="icon">
            <div class="icon-box">
              <img src="image/services (5).png" class="img1">
              <img src="image/services (6).png" class="img2">
            </div>
          </div>
          <div class="detail">
            <h4>Support</h4>
            <span>24*7 hours</span>
          </div>
        </div>

        <div class="box">
          <div class="icon">
            <div class="icon-box">
              <img src="image/service.png" class="img1">
              <img src="image/service (1).png" class="img2">
            </div>
          </div>
          <div class="detail">
            <h4>Returns</h4>
            <span>24*7 free return</span>
          </div>
        </div>

        <div class="box">
          <div class="icon">
            <div class="icon-box">
              <img src="image/services.png" class="img1">
              <img src="image/services (1).png" class="img2">
            </div>
          </div>
          <div class="detail">
            <h4>Delivery</h4>
            <span>100% secure</span>
          </div>
        </div>


      </div>
    </div>
    <div class="categories">
      <div class="heading">
        <h1>Categories features</h1>
        <img src="image/separator-img.png">
      </div>
      <div class="box-container">
        <div class="box">
          <img src="image/categories.jpg">
          <a href="menu.php" class="btn">coconuts</a>
        </div>
        <div class="box">
          <img src="image/categories0.jpg">
          <a href="menu.php" class="btn">chocolate</a>
        </div>
        <div class="box">
          <img src="image/categories2.jpg">
          <a href="menu.php" class="btn">strawberry</a>
        </div>
        <div class="box">
          <img src="image/categories1.jpg">
          <a href="menu.php" class="btn">corn</a>
        </div>
      </div>
    </div></div>
    <img src="image/menu-banner.jpg" class="menu-banner">
    <div class="taste">
      <div class="heading">
        <span>Taste</span>
        <h1>Buy any ice cream</h1>
        <img src="image/separator-img.png">
      </div>
      <div class="box-container">
          <div class="box">
            <img src="image/taste.webp">
            <div class="detail">
              <h2>Natural sweetness</h2>
              <h1>Vanilla</h1>
            </div>
          </div>
          <div class="box">
            <img src="image/taste0.webp">
            <div class="detail">
              <h2>Rich and creamy</h2>
              <h1>Matcha</h1>
            </div>
          </div>
          <div class="box">
            <img src="image/taste1.webp">
            <div class="detail">
              <h2>Natural sweetness</h2>
              <h1>Blueberry</h1>
            </div>
          </div>
      </div>
    </div>
    <div class="ice-container">
      <div class="overlay"></div>
      <div class="detail">
        <h1></h1>Ice cream is cheaper than <br> therapy for stress</h1>
        <p ></p>
        <a href="menu.php" class="btn">Shop Now</a>
      </div>
    </div>
    <div class="taste2">
      <div class="t-banner">
        <div class="overlay"></div>
        <div class="detail">
        <h1>Find your taste of desserts</h1>
        <p>Treat them to a delicious treat and send them some Luck 'o theIrish tool</p>
        <a href="menu.php" class="btn">Shop Now</a>
        </div>
      </div>
      <div class="box-container">
          <div class="box">
            <div class="box-overlay"></div>
            <img src="image/type4.jpg">
            <div class="box-details fadeIn-bottom">
              <h1>Strawberry</h1>
              <p>Find your taste of desserts</p>
              <a href="menu.php" class="btn">Explore more</a>
            </div>
          </div>

          <div class="box">
          <div class="box-overlay"></div>
          <img src="image/type.avif">
          <div class="box-details fadeIn-bottom">
            <h1>Strawberry</h1>
            <p>Find your taste of desserts</p>
            <a href="menu.php" class="btn">Explore more</a>
          </div>
        </div>

        <div class="box">
          <div class="box-overlay"></div>
          <img src="image/type1.png">
          <div class="box-details fadeIn-bottom">
            <h1>Strawberry</h1>
            <p>Find your taste of desserts</p>
            <a href="menu.php" class="btn">Explore more</a>
          </div>

        </div>

        <div class="box">
          <div class="box-overlay"></div>
          <img src="image/type2.png">
          <div class="box-details fadeIn-bottom">
            <h1>Strawberry</h1>
            <p>Find your taste of desserts</p>
            <a href="menu.php" class="btn">Explore more</a>
          </div>

        </div>

        <div class="box">
          <div class="box-overlay"></div>
          <img src="image/type0.avif">
          <div class="box-details fadeIn-bottom">
            <h1>Strawberry</h1>
            <p>Find your taste of desserts</p>
            <a href="menu.php" class="btn">Explore more</a>
          </div>
        </div>

        <div class="box">
          <div class="box-overlay"></div>
          <img src="image/type4.jpg">
          <div class="box-details fadeIn-bottom">
            <h1>Strawberry</h1>
            <p>Find your taste of desserts</p>
            <a href="menu.php" class="btn">Explore more</a>
          </div>
        </div>

      </div>

    </div>
    <div class="flavor">
      <div class="box-container">
        <img src="image/left-banner2.webp">
        <div class="detail">
          <h1>Hot deal! Sale up to <span>20% off</span></h1>
          <p>expired</p>
          <a href="menu.php" class="btn">Shop Now</a>
        </div>
      </div>
    </div>
    

        
    
    <div class="pride">
      <div class="detail">
        <h1>We pride ourselfs on <br> exeptional flavors</h1>
        <p>Our ice cream is made with love</p>
        <a href="menu.php" class="btn">Shop Now</a>
      </div>


    </div>




<?php include 'components/footer.php'; ?>
<script src="js/user_script.js"></script>
<?php include 'components/alert.php'; ?>
    
</body>
</html>