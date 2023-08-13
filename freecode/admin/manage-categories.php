<?php

include 'partials/header.php';


 //fetch categories from database 
 $query = "SELECT *FROM categories ORDER BY  title "; 
 $categories= mysqli_query($connection, $query);

?>

    <!===============================end of the nav_bar =======================================!>


    <section class="dashboard">
        <?php if(isset($_SESSION['add-category-success'])) : // if add category was succesful?> 
                    <div class="alert_message success container">
                        <p>

                            <?= $_SESSION['add-category-success']; 
                                unset($_SESSION['add-category-success']);
                            ?>
                        </p>
                    </div>
        <?php elseif(isset($_SESSION['add-category'])) : // if add category was not succesful?>
                <div class="alert_message error container">
                    <p>

                        <?= $_SESSION['add-category']; 
                            unset($_SESSION['add-category']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['edit-category'])) : // if edit category was not succesful?>
                <div class="alert_message error container">
                    <p>

                        <?= $_SESSION['edit-category']; 
                            unset($_SESSION['edit-category']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['edit-category-success'])) : // if edit category was  succesful?>
                <div class="alert_message success container">
                    <p>

                        <?= $_SESSION['edit-category-success']; 
                            unset($_SESSION['edit-category-success']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['delete-category-success'])) : // if delete category was  succesful?>
                <div class="alert_message success container">
                    <p>

                        <?= $_SESSION['delete-category-success']; 
                            unset($_SESSION['delete-category-success']);
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
                            <h5 ><a href="index.php">Manage Posts</a></h5>
                    </li>
                    <?php if (isset($_SESSION['user_is_admin'])) : ?>
                        <li>
                            <h5><a href="add-user.php">Add User</a></h5>
                        </li>
                        <li>
                            <h5><a href="manage-users.php">Manage User</a></h5>
                        </li>
                        <li>
                            <h5><a href="add-category.php">Add Category</a></h5>
                        </li>
                        <li >
                            <h5 class="active"><a href="manage-categories.php" >Manage Category</a></h5>
                        </li>
                    <?php endif ?>
                </ul>
            </aside>
            <main>
                <h2>Manage Categories</h2>
                <?php  if(mysqli_num_rows($categories)>0) : ?>
                <table>
                    <thead>
                        <tr>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php  while($category= mysqli_fetch_assoc( $categories) ) :?>
                            <tr>
                                <td><?= $category['title']?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id']?>" class="btn sn">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id']?>" class="btn sn danger">Delete</a></td>
                            </tr>
                        <?php  endwhile ?>
                    </tbody>
                </table>
                <?php  else :?>
                    <div class="alert_message error"><?= "No Categories found" ?></div>
                    <?php  endif?>
            </main>
        </div>
    </section>


<?php
 
 include '../partials/footer.php';
?>