<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
    <!-- Navigation -->
<?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

               <div class="form-group">
   
      </div>
                <?php
                if(isset($_GET['p_id']))
                {
                $the_post_id = $_GET['p_id'];
                $author = $_GET['author'];
                }
                $query = "SELECT * FROM posts WHERE post_author='$author' AND post_status ='published' ORDER BY post_id DESC ";
                $select_all_posts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_all_posts))
                {
                 $post_id =  $row['post_id'];
                 $post_title =  $row['post_title'];
                 $post_author = $row['post_author'];
                 $post_date =$row['post_date'];
                 $post_image =$row['post_image'];
                 $post_content =substr($row['post_content'],0,100);
                 $post_tags =$row['post_tags'];
                 $post_comment_count =$row['post_comment_count'];
                 $post_status =$row['post_status'];
                 $post_views_count =$row['post_views_count'];
                 ?>
                
                
                <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

               <div class="media">
                   
                    <div class="media-body">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="" style="border-radius: 50%; height:50px">
                    </a>
                
                <p class="lead">
                    
                <small>
                  <a style="margin-left:15px" href="author_posts.php?author=<?php  $post_author?>&p_id=<?php echo $post_id?>"><?php echo $post_author?></a>
                  </small>
                <small>
                 <h5><span class="glyphicon glyphicon-time"> Posted on <?php echo $post_date?></span></h5>
                </small>
                </p> 
                
                <p><a href="post.php?p_id=<?php echo $post_id ?>"><?php echo "<h4>".$post_title."</h4>" ?></a></p> 
                <?php echo $post_content; if(isset($post_image)){
                if(!empty($post_image)){ ?> 

                <a href="post.php?p_id=<?php echo $post_id ?>">
                <img class="img-responsive" style="width: 800px; border:0.01px solid black" src="<?php echo 'images/'.$post_image  ?>" alt="">
                </a>
                <?php  } } ?>
                <br>        
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

        