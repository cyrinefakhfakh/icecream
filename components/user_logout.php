<?php
    include 'connect.php';
    setcookie('id','',time()-1,'/');
    header('location:../home.php');
?>