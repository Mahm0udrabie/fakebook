<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
    <!-- Navigation -->
<?php include "includes/navigation.php";?>
<script>
</script>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                if(isset($_GET['category']))
                {
                  $postcategory =  $_GET['category']; 
                }
                $stmtPOstcategory = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ? ");
                $published = 'published';
                mysqli_stmt_bind_param($stmtPOstcategory, "is", $postcategory, $published);
       
                mysqli_stmt_execute($stmtPOstcategory);
        
                mysqli_stmt_bind_result($stmtPOstcategory, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);


                // $query = "SELECT * FROM posts WHERE post_category_id ='$postcategory' AND post_status= 'published' ";
                // $select_all_posts = mysqli_query($connection, $query);
                // while ($row = mysqli_fetch_assoc($select_all_posts))
                // {
                    while(mysqli_stmt_fetch($stmtPOstcategory)){
                //  $post_id =  $row['post_id'];
                //  $post_title =  $row['post_title'];
                //  $post_author = $row['post_author'];
                //  $post_user = $row['post_user'];
                //  $post_date =$row['post_date'];
                //  $post_image =$row['post_image'];
                //  $post_content =$row['post_content'];
                //  $post_tags =$row['post_tags'];
                //  $post_comment_count =$row['post_comment_count'];
                //  $post_status =$row['post_status'];
                //  $post_views_count =$row['post_views_count'];
                 ?>
                
                
                <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

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
                
                <br>    <br> 
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
   
                </div>
                
                </div>
             
       

                

          
   <?php } ?>      
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

        