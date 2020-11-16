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
                if(isset($_GET['p_id']))
                {

                //select posts by get id
                $post_id=$_GET['p_id']; 
                $vpstatus ="";
                $Lpstatus="";
                $active_class = "";
                //// select form views table
                $selectViewcount = "SELECT * FROM views WHERE post_view_id ='$post_id' AND username ='" .$_SESSION['username']."' ";
                $send_view_Selectquery = mysqli_query($connection ,$selectViewcount);
                
                while ($row_views = mysqli_fetch_assoc($send_view_Selectquery)) {                   
                $vpstatus = $row_views['vpstatus'];
                }
                        
                


                // insert into views table
                if(!$vpstatus)
                {
                $userView  = $_SESSION['username'];
                $encryptVP= $post_id.$userView;
                $viewQuery = mysqli_prepare($connection,"INSERT INTO views (post_view_id,username,vpstatus) VALUES (?,?,?) ");
                mysqli_stmt_bind_param($viewQuery,'iss',$post_id,$userView,$encryptVP);
                if(mysqli_stmt_execute($viewQuery) === false) 
                {
                    die(" error in query ".mysqli_error($connection));
                }
            }
            if(!$vpstatus)
            {
                    // update count of posts view
                    $updateVPcount = mysqli_prepare($connection," UPDATE posts SET post_views_count = post_views_count + ? WHERE post_id = ?  ");
                    if ($updateVPcount === false) {
                    die(" error in query ".mysqli_error($connection));
                    }
                    $countVP = 1;
                    mysqli_stmt_bind_param($updateVPcount ,'ii', $countVP , $post_id);
                    if (mysqli_stmt_execute($updateVPcount)=== false) {
                    die(" error in query ".mysqli_error($connection));
                    }
                    
                }
                
                  

                if(isset($_POST['like-button'])) {
                     //// select form post_likes table

                
                   $selectLikecount = "SELECT * FROM post_likes WHERE post_like_id ='$post_id' AND username ='" .$_SESSION['username']."' ";
                   $send_Like_Selectquery = mysqli_query($connection ,$selectLikecount);
                   
                   while ($row_views = mysqli_fetch_assoc($send_Like_Selectquery)) {                   
                     $Lpstatus = $row_views['user_status'];
                     $active_class = $row_views['active_class'];
                   }   
                
                   // insert into post_views table

                   if(!$Lpstatus)
                   {
                   $userLike  = $_SESSION['username'];
                   $encryptLP= $post_id."like";
                   $activeClass ="like";
                   $LikeQuery = mysqli_prepare($connection,"INSERT INTO post_likes (post_like_id,username,user_status,active_class) VALUES (?,?,?,?) ");
                   mysqli_stmt_bind_param($LikeQuery,'isss',$post_id,$userLike,$encryptLP,$activeClass);
                   if(mysqli_stmt_execute($LikeQuery) === false) 
                   {
                       die(" error in query ".mysqli_error($connection));
                   }
               }
               if(!$Lpstatus)
               {
                       // update count of posts view
                       $updatelPcount = mysqli_prepare($connection," UPDATE posts SET post_likes = post_likes  + ? WHERE post_id = ?  ");
                       if ($updatelPcount === false) {
                       die(" error in query ".mysqli_error($connection));
                       }
                       $countlP = 1;
                       mysqli_stmt_bind_param($updatelPcount ,'ii', $countlP , $post_id);
                       if (mysqli_stmt_execute($updatelPcount)=== false) {
                       die(" error in query ".mysqli_error($connection));
                       }
                       
                   }
                   if($Lpstatus)
               {
                   //delete user like 
                        $deleteuserlike = mysqli_prepare($connection,"DELETE FROM post_likes WHERE user_status = ? AND username ='".$_SESSION['username']."'  ");
                        if ($deleteuserlike === false) {
                            die(" error in query ".mysqli_error($connection));
                            }
                            mysqli_stmt_bind_param($deleteuserlike ,'s',$Lpstatus);
                            if (mysqli_stmt_execute($deleteuserlike)=== false) {
                            die(" error in query ".mysqli_error($connection));
                            }

                                          // update count of posts likes
                       $updatelPcount = mysqli_prepare($connection," UPDATE posts SET post_likes = post_likes  - ? WHERE post_id = ?  ");
                       if ($updatelPcount === false) {
                       die(" error in query ".mysqli_error($connection));
                       }
                       $countlP = 1;
                       mysqli_stmt_bind_param($updatelPcount ,'ii', $countlP , $post_id);
                       if (mysqli_stmt_execute($updatelPcount)=== false) {
                       die(" error in query ".mysqli_error($connection));
                       }
                       
                   }
                
                }
                //select specific post
                $query = "SELECT * FROM posts WHERE post_id ='$post_id' AND post_status= 'published' ";
                $select_all_posts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_all_posts))
                {
                $post_title =  $row['post_title'];
                $post_author = $row['post_author'];
                $post_date =$row['post_date'];
                $post_image =$row['post_image'];
                $post_content =$row['post_content'];
                $post_tags =$row['post_tags'];
                $post_comment_count =$row['post_comment_count'];
                $post_status =$row['post_status'];
                $post_views_count =$row['post_views_count'];
                $post_likes = $row['post_likes'];
                 ?>
                
                
                <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

                <!-- First Blog Post --> 
                <div class="media"><?php if($post_likes > 0 ) { ?>  <div id="likescount" class="text-center">
                <span class="glyphicon glyphicon-thumbs-up" style="font-size:20px;"></span>
              <?php echo $post_likes;?></div><?php } ?>

                   <div class="media-body">
                   <a class="pull-left" href="#">
                   <?php 
                   
                   $queryimage = "SELECT * FROM users WHERE username = '$post_author' ";
                   $select_image = mysqli_query($connection, $queryimage);
                   while ($rowimage = mysqli_fetch_assoc($select_image)):
                   
                       $user_image = $rowimage['user_image'];
                   
                   if($user_image) {
                   ?>
                   <img class="media-object" src='images/<?php echo $user_image ?>' alt="" style="border-radius: 50%; height:50px">                    
                   <?php } else{ ?>
                       <img class="media-object" src="http://placehold.it/64x64" alt="" style="border-radius: 50%; height:50px">
                   <?php } endwhile; ?>
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
               <?php } ?>

               <hr> <div class="text-center" >
               <p style="font-size:18px;float:left;"> <i class="fa fa-eye" style="font-size:18px;"></i><?php echo "  " . "  " . $post_views_count." " ?>views
               <?php  if( $post_author === $_SESSION['username']) { ?>


                <form method="post" style="float:right" >

                    <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                    <button onclick="javascript: return confirm('Are you sure you want to delete');"  name="delete" class="btn-lg" type="submit" style="border:none;background-color: transparent;">
                    <span class="glyphicon glyphicon-trash  text-danger" style="font-size:18px;"></span> 
                    </button>
                    <style>
                    .btn-lg
                    {
                        padding:0px 0px !important;
                    }
                    </style>

                </form>


                    <?php 

                    if(isset($_POST['delete'])){

                    $post_id =mysqli_real_escape_string($connection,$_POST['post_id']);
                    $delete_post = mysqli_prepare($connection , "DELETE FROM posts WHERE post_id = ?");
                    mysqli_stmt_bind_param($delete_post,'i',$post_id);
                    mysqli_stmt_execute($delete_post);
                    if(!$delete_post)
                    {
                        die("QUERT NOT WORK".mysqli_error($connection));
                    }
                    header("Location: index.php");


                    }

                    ?>
               
               <?php  } ?>
               







                    <form action="" method="post"class="text-center">
                    <button  type="submit" class="li-ke" name="like-button"><span class="glyphicon glyphicon-thumbs-up"></span>&ensp;Like</button>
      
                    <style>
                    #likescount 
                    {
                    width:10%;
                    position: absolute;
                    left:80%;
                    border:0px solid #3B5998;
                    color:#3B5998;
                    display: inline-block;
                    font-weight:bold;
                    }
                   
                    </style>

                    </form> 
                    </div>
                    <style>
                    .li-ke {
                    font-size:18px;
                    background-color:transparent;
                    outline:none;
                    width:100px;
                    border:0px solid;
                    color:gray;
                    font-family: italic;
                    }
                    </style>
                    <style>
                    .like {
                    color:#3B5998;
                    } 
                    </style>
                    <?php 
                    $current_status = "";
                    $selectlikes = "SELECT * FROM post_likes WHERE post_like_id ='$post_id' AND username='".$_SESSION['username']."'" ;
                    $sendlikequery = mysqli_query($connection,$selectlikes);
                    while($fetchrow = mysqli_fetch_array($sendlikequery)) 
                    {
                        $current_status = $fetchrow['user_status'];
                    }
                    ?>
                <?php if($current_status == $post_id."like") { ?>
                <script>
                $(document).ready(function() {
                $('.li-ke').addClass("like");
                }); 
                </script>

                <?php } if($current_status != $post_id."like") { ?>
                <script>
                $(document).ready(function() {
                $('.li-ke').removeClass("like");
                }); 
                </script>
                <?php   } ?>

             
  
               </div>
               
               </div>
            
                <hr>
                 
                <!-- Blog Comments -->
                <?php  
                if($post_status ='published') {
                if(isset($_POST['comment']))
                {
                    $post_id=$_GET['p_id'];
                $commentauthor = $_POST['comment_author'];
                $commentemail =  $_POST['comment_email'];
                $commentcontent = $_POST['comment_content'];
                $commentdate = date('d-m-y');
                if(!empty($commentauthor) && !empty($commentemail) && !empty($commentcontent) )
                {

                $sql = "INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_date) VALUES ('$post_id','$commentauthor','$commentemail','$commentcontent', now()) ";
                $query_connection = mysqli_query($connection , $sql);
                include "admin/functions.php";
                catch_errors($query_connection);

                }
                else 
                {
                    $wrong = "<p style='color:red'>fields can not be empty</p>";
                }
                }
                ?>
                    <?php }  
                    ?>         
             <!-- Comments Form -->
                <div class="well" style="background-color:white;">                    
                <form role="form" action="" method="post">
                <?php 
                    if(isset($wrong))
                    {
                        echo $wrong."<br>";
                    }
                    ?>
                <?php if(isset($_SESSION['username'])) { ?>
                <?php
                 $query_of_user_comment ="SELECT * FROM users WHERE username='" . $_SESSION['username'] . "' ";
                $sendQuery =mysqli_query($connection , $query_of_user_comment);
                while($rowofusercomment=mysqli_fetch_assoc($sendQuery))
                {
                  $usernameofcommentauthor = $rowofusercomment['username'];
                  $useremailofcomment = $rowofusercomment['user_email'];
                  $comment_username_role = $rowofusercomment['user_role'];
                  $comment_username_image = $rowofusercomment['user_image'];

                  if($comment_username_role == 'Admin')
                  {
                  $updatequery_status_ofcomment="UPDATE comments SET comment_status ='approved' WHERE comment_post_id ='$post_id' ";
                  $send_Query_of_update_status = mysqli_query($connection , $updatequery_status_ofcomment) ;  
                    }
                } 
                ?>
                

                    <div class="form-group">
                    
                  
                            <input type="hidden" value="<?php echo $usernameofcommentauthor; ?>" name="comment_author" class="form-control" >
                        </div>
                        <div class="form-group">
                            <input type="hidden" value="<?php echo  $useremailofcomment; ?>" name="comment_email" class="form-control" >
                        </div>
                
                <div class="form-group">
               
                        <label for="email">Your Comment</label>

                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit"  name="comment" class="btn btn-primary">Submit</button>
                <?php } if (!isset($_SESSION['username'])) {?>
                    <h4>Leave a Comment:</h4>
                
                    <div class="form-group" >
                    <label for="author name">Author Name</label>
                            <input type="text" name="comment_author" class="form-control" >
                        </div>
                        <div class="form-group">
                        <label for="email">Email</label>
                            <input type="email" name="comment_email" class="form-control" >
                        </div>
                        <div class="form-group">
                        <label for="email" style="color:black;">Your Comment</label>

                            <textarea  class="form-control" name="comment_content" rows="3" placeholder="Describe yourself here...">
                            
                            </textarea>
                        </div>
                        <button type="submit"  name="comment" class="btn btn-primary">Submit</button>
                <?php }
                ?>
                <style>
                label 
                {
                    color: black;
                }
                </style>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php 
                $query_comment = "SELECT * FROM comments WHERE comment_post_id = '$post_id' And comment_status = 'approved'  ORDER BY comment_id DESC ";
                $select_query = mysqli_query($connection ,$query_comment);

                while($commentrow = mysqli_fetch_assoc($select_query))
                {
                    $comment_id = $commentrow['comment_id'];
                    $comment_post_id= $commentrow['comment_post_id'];
                    $comment_author= $commentrow['comment_author'];
                    $comment_content =$commentrow['comment_content'];
                    $comment_email =$commentrow['comment_email'];
                    $comment_status =$commentrow['comment_status'];
                    $comment_date = $commentrow['comment_date'];
                ?>



                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="" style="border-radius: 50%; height:50px">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php  echo "<br>posted in ".$comment_date."<br>"?></small>
                        
                        <?php echo $comment_content;?> </h4> 


                      <!-- Nested Comment -->
                      <?php 
                        $reply_query = "SELECT * FROM replies WHERE reply_comment_id ='$comment_id'";
                        $select_reply = mysqli_query($connection ,$reply_query);

                        while($replyrow = mysqli_fetch_assoc($select_reply))
                        {
                            $reply_id = $replyrow['reply_id'];
                            $reply_comment_id= $replyrow['reply_comment_id'];
                            $reply_author= $replyrow['reply_author'];
                            $reply_content =$replyrow['reply_content'];
                            $reply_date = $replyrow['reply_date'];
                        ?>






                    <!--<div class="media">-->
                    <!--        <a class="pull-left" href="#">-->
                    <!--            <img class="media-object" src="http://placehold.it/64x64" alt="" style="border-radius: 50%; height:50px" >-->
                    <!--        </a>-->
                    <!--        <div class="media-body">-->
                    <!--            <h4 class="media-heading"><?php //echo  $reply_author; ?>-->
                    <!--                <small><?php //echo  $reply_date; ?></small>-->
                    <!--            </h4>-->
                    <!--            <?php //echo  $reply_content; ?> -->
                    <!--        </div>-->
                            
                        </div>
                       
                        <!-- End Nested Comment -->

                        <?php  } ?>
                        <!--<br>-->
                        <!--<form action="" method="post">-->
                        <?php 
                        // if(isset($_POST['reply']))
                        {
                        // $userreplycontetn=$_POST['reply_content'];
                        // $reply_date = date('y-m-d');
                        
                        // $insertreply = "INSERT INTO replies (reply_comment_id,reply_author,reply_content,reply_date) VALUES ('$comment_id',' $usernameofcommentauthor','$userreplycontetn',now())";
                        // $SENDREPLYQUERY = mysqli_query($connection,$insertreply);
                         ?>                  
                               <?php } ?>

                     <!--   <input type="hidden" value="<?php //echo  $usernameofcommentauthor; ?>" >
                            <input type="text" name="reply_content" > <button type="submit" name="reply">reply</button>
                            </form>-->
                   






                        </div>
                     
                </div>
              <hr>
            <?php } }  } ?>

              
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

        