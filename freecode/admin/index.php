<?php

include 'partials/header.php';

//fetch cureent users's post from database
$current_user_id = $_SESSION['auth']['id'];
if (isset($_SESSION['user_is_admin'])){
    $query = "SELECT * FROM posts  ORDER BY id DESC";
    $posts = mysqli_query($connection, $query);
}else{
    $query = "SELECT * FROM posts  WHERE author_id=$current_user_id ORDER BY id DESC";
    $posts = mysqli_query($connection, $query);
} 

?>


<section class="dashboard">
    <?php if(isset($_SESSION['add-post-success'])) : ?>
                <div class="alert_message success container">
                    <p>

                        <?= $_SESSION['add-post-success']; 
                            unset($_SESSION['add-post-success']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['edit-post-success'])) : ?>
                <div class="alert_message success container">
                    <p>

                        <?= $_SESSION['edit-post-success']; 
                            unset($_SESSION['edit-post-success']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['edit-post'])) : //shows if edit was not succesful ?>
                <div class="alert_message error container">
                    <p>

                        <?= $_SESSION['edit-post']; 
                            unset($_SESSION['edit-post']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['delete-post'])) : //shows if delete was not succesful ?>
                <div class="alert_message error container">
                    <p>

                        <?= $_SESSION['delete-post']; 
                            unset($_SESSION['delete-post']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['delete-post-success'])) : //shows if delete was  succesful ?>
                <div class="alert_message success container">
                    <p>

                        <?= $_SESSION['delete-post-success']; 
                            unset($_SESSION['delete-post-success']);
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
                            <h5  class="active"><a href="index.php">Manage Posts</a></h5>
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
                        <li class="active">
                            <h5><a href="manage-categories.php" >Manage Category</a></h5>
                        </li>
                    <?php endif ?>
                </ul>
            </aside>
            <main>

                <h2>Manage Posts </h2>
                <?php if(mysqli_num_rows($posts ) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            
                                <th>Edit</th>
                                <th>Delete</th>
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($post = mysqli_fetch_assoc($posts)) : ?>
                            <?php
                                $category_id = $post['category_id'];
                                $category_query = "SELECT title FROM categories WHERE id = $category_id";
                                $category_result = mysqli_query($connection, $category_query);
                                $category = mysqli_fetch_assoc($category_result);
                                
                            ?>
                            <tr>
                                <td><?= $post['title']; ?></td>
                                <td><?= $category['title']; ?></td>

                                
                                    <td><a href="<?=  ROOT_URL ?>admin/edit-post.php?id=<?=  $post['id']; ?>" class="btn sn">Edit</a></td>
                                    <td><a href="<?=  ROOT_URL ?>admin/delete-post.php?id=<?=  $post['id']; ?>" class="btn sn danger">Delete</a></td>
                              
                            </tr>
                        <?php endwhile ?>

                        
                    </tbody>
                </table>
                <?php else : ?>
                    <div class="alert_message  error"><?= "Aucun post n'a ete trouver dans l'application :( "?></div>
                <?php endif?>
            </main>
        </div>
</section>

<?php
 
 include '../partials/footer.php';
 ?>