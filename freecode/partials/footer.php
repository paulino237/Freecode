<?php


$query = "SELECT * FROM posts ORDER BY date_time ";
$posts = mysqli_query($connection, $query);
?>




<footer>
    <div class="footer_socials" align="center">
            <a href="">Facebook</a>
            <a href="">Whatsapp</a>
            <a href="">Instagram</a>
     </div>
    <div class="container footer_container">
            
           
        <article>
            <h4>Categories</h4>
            <ul>
                <?php
                        $all_categories_query = "SELECT * FROM categories";
                        $all_categories = mysqli_query($connection, $all_categories_query);


                    
                ?>
                    <?php  while($category = mysqli_fetch_assoc($all_categories)) : ?>
                        <li><a href="<?= ROOT_URL?>./category-post.php?id=<?= $category['id']?>"><?= $category['title']?></a></li>
                    <?php endwhile ?>
            </ul>               
        </article>
            
            <article>
                <h4>Blog</h4>
                <ul>
                    <li><a href="">Popular</a></li>
                    <li><a href="">Evenements</a></li>
                    <li><a href="">Challenge</a></li>
                    <li><a href="">Quizz</a></li>
                   
                </ul>
            </article>


            <article>
                <h4>Permalinks</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="service.php">Services</a></li>
                    <li><a href="signin.php">Signin</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </article>
        </div>
        <div class="footer_copyright">
            <small>COPYRIGHT &copy; 2022 FREE CODE</small>
</div></div>
</footer>

    <script src="<?= ROOT_URL ?>/js/main.js"></script>