<?php include '../components/connect.php';
if (isset($_COOKIE['seller_id'])) {
    $seller_id=$_COOKIE['seller_id'];}
else{
    $seller_id='';
    header('location:loging.php');}
    

 

?>


<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Sky Summer registration</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
</head>
<body>
<div class="main-container">
    <?php include '../components/admin_header.php'; ?>
</div>










<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>
<?php include '../components/alert.php'; ?>
</body>
</html>