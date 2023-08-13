<?php
include 'partials/header.php';

//fetch categories drom database

$category_query = "SELECT * FROM categories"; 
$categories = mysqli_query($connection, $category_query);

//fetch post dta form 
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id"; 
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
}else{
    header('location:' .ROOT_URL. 'admin/');
    die();
}


?>

    <!===============================end of the nav_bar =======================================!>
        <br><br>

    <section class="form_section">
        <div class="container form_section-container">
            <h2>Edit Post</h2>
            <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="" value="<?= $post['id'] ?>">
                <input type="hidden" name="previous_thumbnail_name" id="" value="<?= $post['thumbnail'] ?>">
                <input type="text" name="title" id="" value="<?= $post['title'] ?>" placeholder=" Title">
                <select name="category" id="">
                    <?php  while( $category = mysqli_fetch_assoc($categories)) : ?>

                            <option value="<?= $category['id']?> "><?= $category['title']?></option>
                            
                    <?php endwhile?>
                </select>
                <textarea name="body" id=""  rows="10" placeholder="Body"> <?= $post['body'] ?></textarea>
                <div class="form_control inline">
                    <input type="checkbox"  value="1" name="is_featured" id="is_featured"checked>
                    <label for="is_featured"   checked>Featured</label>
                </div>
                <div class="form_control">
                    <label for="thumbail"> Change Thumbail</label>
                    <input type="file" name="thumbnail" id="thumbail" placeholder="Choose File">
                </div>
               <button type="submit" name="submit" class="btn">Edit Post</button>
            </form>
        </div>
    </section>

        <br><br>

<?php
 
 include '../partials/footer.php';
 ?>