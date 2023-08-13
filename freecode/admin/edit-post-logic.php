<?php
require 'config/database.php'; 

if(isset($_POST['submit'])){
    $id = filter_var($_POST['id' ] , FILTER_SANITIZE_NUMBER_INT); 
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail']; 

    //set is_featured to if it was unchecked
    $is_featured = $is_featured == 1 ?: 0;

    if(!$title){
        $_SESSION['edit-post'] ="Couldn't update Invalid form data";
    }elseif(!$category_id){
        $_SESSION['edit-post'] = "Couldn't update Invalid form data ";
    }elseif(!$body){
        $_SESSION['edit-post'] = "Couldn't update Invalid form data";
    }else{
        //delete la photo existante

        if($thumbnail['name']){
            $previous_thumbnail_path = '../images_of_site/'.$previous_thumbnail_name;
            if($previous_thumbnail_path ){
                unlink($previous_thumbnail_path);
            }

            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name']; 
            $thumbnail_destination_path = '../images_of_site/' . $thumbnail_name;

            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.' , $thumbnail_name);
            $extension = end($extension);


            if( in_array($extension, $allowed_files)){
                if($thumbnail['size'] < 2000000000){
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                }else{
                    $_SESSION['edit-post'] = "Couldn't update post thumbnail is big shoukd be less than 2mb"; 
                }
            }else{
                $_SESSION['edit-post'] = 'Couldn update post thumbnail should be png jpg or jpeg';
            }
           
        }

       
    }

    if (isset($_SESSION['edit-post'])){
        //redirect to mannage page if form was invalid
        header('location:' .ROOT_URL. 'admin/');
        die();
    }else{
        if($is_featured == 1){
            $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;


        $edit_post_query = $connection->prepare(" UPDATE  posts SET title=? , body=? , thumbnail=? , category_id=? , is_featured=?  WHERE id=$id ");
        $edit_post_query->execute(array(
            $title, $body,$thumbnail_to_insert,  $category_id,   $is_featured
        ));

        $_SESSION['edit-post-success'] = "Post modifier avec success :) "; 
        header('location:' .ROOT_URL. 'admin/'); 
        die();
    }

    
}






?>