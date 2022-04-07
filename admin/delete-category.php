<?php
    include "config.php";
    $cat_id = $_GET['id'];
    $sql = "DELETE FROM category WHERE category_id = {$cat_id}";
    if(mysqli_query($conn, $sql)){
        header("Location: {$hostname}/admin/category.php");
    }else{
        echo "Cant Del Records.";
    }
    mysqli_close($conn);
?>