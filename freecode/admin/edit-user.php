<?php

include 'partials/header.php';
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id= $id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} else{
    header('location:' .ROOT_URL. 'admin/manage-user');
    die();
}

?>

    <!===============================end of the nav_bar =======================================!>
        <br><br>

    <section class="form_section">
        <div class="container form_section-container">
            <h2>Edit User</h2>
            <form action="<?= ROOT_URL?>admin/edit-user-logic.php" method="POST">
                <input type="hidden" value="<?= $user['id']?>" name="id" >
                <input type="text" value="<?= $user['firstname']?>" name="firstname" id="" placeholder="First Name">
                <input type="text" value="<?= $user['lastname'] ?>"name="lastname" id="" placeholder="Last Name">
                <select name="userrole" >
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>
              
               <button type="submit" name="submit" class="btn">Uptade User</button>
            </form>
        </div>
    </section>

        <br><br><br><br>

<?php
 
 include '../partials/footer.php';
 ?>