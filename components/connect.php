<?php
$db_name='mysql:host=localhost;dbname=icecream_db';
$user_name='root';
$password='';
$conn=new PDO($db_name,$user_name,$password);
if(!$conn){
    echo "Not Connected";
}
function unique_id(){
    $chars="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charLength=strlen($chars);
    $randomString="";
    for($i=0;$i<20;$i++){
        $randomString.=$chars[rand(0,$charLength-1)];

    }
    return $randomString;
}   
?>