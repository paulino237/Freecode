<?php

include 'partials/header.php';

//fetch user from databse but not current user
//$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users ";
$users = mysqli_query($connection, $query);

?>


<section class="dashboard">
        <?php if(isset($_SESSION['add-user-success'])) : ?>
                <div class="alert_message success container">
                    <p>

                        <?= $_SESSION['add-user-success']; 
                            unset($_SESSION['add-user-success']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['edit-user-success'])) : ?>
                <div class="alert_message success container">
                    <p>

                        <?= $_SESSION['edit-user-success']; 
                            unset($_SESSION['edit-user-success']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['edit-user'])) : //shows if edit was not succesful ?>
                <div class="alert_message error container">
                    <p>

                        <?= $_SESSION['edit-user']; 
                            unset($_SESSION['edit-user']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['delete-user'])) : //shows if delete was not succesful ?>
                <div class="alert_message error container">
                    <p>

                        <?= $_SESSION['delete-user']; 
                            unset($_SESSION['delete-user']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['delete-user-success'])) : //shows if delete was  succesful ?>
                <div class="alert_message success container">
                    <p>

                        <?= $_SESSION['delete-user-success']; 
                            unset($_SESSION['delete-user-success']);
                        ?>
                    </p>
                </div>
        <?php endif ?>
        <div class="container dashboard_container">
            <button id="show_sidebar-btn" class="sidebar_toggle">board</button>
            <button id="hide_sidebar-btn" class="sidebar_toggle">Close</button>
           
            <aside>
                <ul>
                    <li>
                        <h5><a href="add-post.php">Add Post</a></h5>
                    </li>
                    <li>
                        <h5><a href="index.php">Manage Posts</a></h5>
                    </li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li>
                        <h5><a href="add-user.php">Add User</a></h5>
                    </li>
                    <li>
                        <h5 class="active"><a href="manage-users.php">Manage User</a></h5>
                    </li>
                    <li>
                        <h5><a href="add-category.php">Add Category</a></h5>
                    </li>
                    <li class="active">
                        <h5><a href="manage-categories.php" >Manage Category</a></h5>
                    </li>

                <?php endif ?>
                </ul>
            </aside>
            <main>
                <h2>Manage Users</h2>
                <?php if(mysqli_num_rows($users  )>0) : ?>
                <table>
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Admin</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php while($user = mysqli_fetch_assoc($users) ) :?>
                            <tr>
                                <td><?= "{$user['firstname']} {$user['lastname']}"?></td>
                                <td><?= $user['username'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id']?>" class="btn sn">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id']?>" class="btn sn danger">Delete</a></td>
                                <td><?= $user['is_admin'] ? 'Yes' : 'No'?></td>
                            </tr>
                        <?php endwhile ?>
                    
                        
                    </tbody>
                </table>
                <?php else:?>
                    <div class="alert_message  error"><?= "No users found"?></div>
                <?php endif?>
            </main>
        </div>
</section>


<?php
 
 include '../partials/footer.php';
 ?>