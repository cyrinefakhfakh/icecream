
<header class="header">
    <section class="flex">
        <a href="home.php" class="logo"></a>
            <img src="image/iceelogo.png" width="50px" alt="logo" style="margin-right:0px;">
            <nav class="navbar">
                <a href="home.php" >Home</a>
                <a href="about-us.php">About</a>
                <a href="menu.php">Shop</a>
                <a href="order.php">Gallery</a>
                <a href="contact.php">Contact</a>

            </nav>
            <form action="" method="post" class="search-form">
               <input type="text" name="search_product" placeholder="Search product..." required
               maxlengh="100">
               <button type="submit" class="bx bx-search-alt-2" id="search_product_btn">Search</button> 
            </form>
            <div class="icons">
                <div class="bx bx-list-plus" id="menu-btn"></div>
                <div class="bx bx-search-alt-2" id="search-btn"></div>
                <a href="wishlist.php"><i class="bx bx-heart"></i><sup>o</sup></a>
                <a href="cart.php"><i class="bx bx-cart"></i><sup>o</sup></a>
                <div class="bx bxs-user" id="user-btn"></div>
            </div>
            <div class="profile-detail">
                <?php
                    $select_profile=$conn->prepare("SELECT * FROM users WHERE id=?");
                    $select_profile->execute([$id]);
                    if ($select_profile->rowCount()>0) {
                        $fetch_profile=$select_profile->fetch(PDO::FETCH_ASSOC);

                ?> 
                <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
                <h3 style="margin-bottom: 1rem;"><?= $fetch_profile['name']; ?></h3>
                <div class="flex-btn">
                    <a href="profile.php" class="btn">Profile</a>
                    <a href="components\user_logout.php" onclick="return confirm('logout from this website');" class="btn">Logout</a>
                </div>
                <?php }else { ?>
                    <h3 style="margin-bottom: 1rem;">Please login or register</h3>
                    <div class="flex-btn">
                        <a href="login.php" class="btn">Login</a>
                        <a href="register.php" class="btn">Register</a>
                    </div>
                <?php } ?>          
                        
                    

                
            </div>
        
    </section>
</header>