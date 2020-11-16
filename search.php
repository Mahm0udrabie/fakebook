<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
    <!-- Navigation -->
<?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php

             

if(isset($_POST['submit'])){
    
$search = $_POST['search'];
    
    
$query = "SELECT * FROM posts WHERE post_category LIKE '%$search%' OR  post_tags LIKE '%$search%' OR post_title LIKE '%$search%' OR post_content LIKE '%$search%' ";
$search_query = mysqli_query($connection, $query);

if(!$search_query) {

    die("QUERY FAILED" . mysqli_error($connection));

}

$count = mysqli_num_rows($search_query);

while($row = mysqli_fetch_assoc($search_query)) {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_status = $row['post_status'];
    

    


?>

  
    <!-- First Blog Post -->   
           
                <div class="media">
                   
                    <div class="media-body">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="" style="border-radius: 50%; height:50px">
                    </a>
                
                <p class="lead">
                    
                <small>
                  <a style="margin-left:15px" href="author_posts.php?author=<?php echo $post_author?>&p_id=<?php echo $post_id?>"><?php echo $post_author?></a>
                  </small>
                <small>
                 <h5><span class="glyphicon glyphicon-time"> Posted on <?php echo $post_date?></span></h5>
                </small>
                </p> 
                
                <p><a href="post.php?p_id=<?php echo $post_id ?>"><?php echo "<h4>".$post_title."</h4>" ?></a></p> 
                <?php echo $post_content; if(!empty($post_image)){?> 

                <a href="post.php?p_id=<?php echo $post_id ?>">
                <img class="img-responsive" style="width: 800px; border:0.01px solid black" src="<?php echo 'images/'.$post_image  ?>" alt="">
                </a>
                
                <?php  } ?>
                
                <br>     <br>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
   
                </div>
                
                </div>
             
 
<?php } 


}


?>
</div>

            <!-- Blog Sidebar Widgets Column -->
            <?php 
include "includes/sidebar.php";
?>
            
        </div>
        <!-- /.row -->

        <hr>
        <?php 
include "includes/footer.php";
?>

        