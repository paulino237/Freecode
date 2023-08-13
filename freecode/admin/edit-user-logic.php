<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    //get  update 
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);


    //chechk for valid input
    if(!$firstname || !$lastname){
        $_SESSION['edit-user']= "Invalid Form input";
    }else{
        //update user
        $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', is_admin=$is_admin WHERE  id=$id LIMIT 1 ";
        $result = mysqli_query($connection, $query);
    
        if(!mysqli_errno($connection)){
            $_SESSION['edit-user'] = "Failed update user";
        }else{
            $_SESSION['edit-user-success'] = "user $firstname  $lastname uptade succesful";
        }
    }
    
    
}


header('location:'.ROOT_URL. 'admin/manage-users.php');
die();

?>