<header>
    <div class="logo">
        <img src="../image/logo.png" alt="logo" width="200">
    </div>
    <div class="right">
        <div class="bx bxc-user" id="user-btn"></div>
        <div class="toggle-btn" ><i class="bx bx-menu"></i></div>

    </div>
    <div class="profile">
        <?php 
        $select_profile=$conn->prepare("SELECT * FROM seller WHERE id=?");
        $select_profile->execute([$seller_id]);
        if($select_profile->rowCount()>0){
            $fetch_profile=$select_profile->fetch(PDO::FETCH_ASSOC);
           
        ?>
        <div class="profile">
            <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" width="100">
            <p><?= $fetch_profile['name']; ?></p>
            <div class="flex-btn">
                <a href="profile.php" class="btn">Profile</a>
                <a href="logout.php" class="btn" onclick="return confirm('logout from this website?');" >Logout</a>

            </div>
        </div>

        <?php } ?>
    </div>
</header>