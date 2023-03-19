<?php

$db = mysqli_connect('localhost','root','abdul','ecommerce');
if(!$db){
    throw new Exception("Database gagal terdeteksi",1);
}

?>