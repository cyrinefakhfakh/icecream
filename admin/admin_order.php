<?php include '../components/connect.php';
if (isset($_COOKIE['seller_id'])) {
    $seller_id=$_COOKIE['seller_id'];}
else{
    $seller_id='';
    header('location:loging.php');}
if (isset($_POST['delete_msg'])) {
    $delete_id=$_POST['delete_id'];
    $delete_id=filter_var($delete_id,FILTER_SANITIZE_STRING);

    $verify_delete=$conn->prepare("SELECT * FROM message WHERE id=?");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount()>0) {
        $delete_message=$conn->prepare("DELETE FROM message WHERE id=?");
        $delete_message->execute([$delete_id]);
        $success_msg[]='Message deleted successfully';
    }
    else{
        $warning_msg[]='Message already deleted';
    }
    
}

 

?>


<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Blue Sky Summer Dashboard page</title>
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
    </head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="dashboard">
            <div class="heading">
                <h1>total orders placed</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">
                
                

            </div>


        </section>

    </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>
<?php include '../components/alert.php'; ?>
</body>
</html>