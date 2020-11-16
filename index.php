<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
    <!-- Navigation -->
<?php include "includes/navigation.php";?>

            
    <!-- Page Content -->
    <div class="container">
 <?php
    // if(isset($_SESSION['wrongvalue']))
    // {
    //     header( "refresh:10;url=includes/logout.php");
    // }
    ?>
        <div class="row">
            <?php 
            if(isset($_SESSION['username']))
            {

            ?>
            <style>

            </style>

            <!-- Blog Entries Column -->
            <div class="col-md-8">

               <div class="form-group"style="margin-right:5%;">
         <!-- <label for="post_content">Post Content</label> -->
         <form action=""method="post" encType="multipart/form-data">
         <?php
         if(isset($_POST['submit']))
         {
         $post_title         = "";
         $post_author        = $_SESSION['username'];
         $post_category_id   = $_POST['post_category_id'];
         $post_comment_count = 0;
         $post_status        = 'published';
         $post_views         = 0;
         $post_date          = date("F j, Y, g:i a");
         $post_image         = $_FILES['image']['name'];
         $post_image_temp    = $_FILES['image']['tmp_name'];
         if(isset($post_image)){
             if(!empty($post_image)){
                 
         
         move_uploaded_file($post_image_temp, "images/$post_image" );
                 
             }
         }
         $post_content      = mysqli_real_escape_string($connection,$_POST['post_content']);
         $post_tags         = " ";
         $stmtAddpost = mysqli_prepare($connection,"INSERT INTO posts (post_title,post_author,post_category_id,post_comment_count,post_status,post_image,post_date,post_content,post_tags,post_views_count) VALUES (?, ?,?, ?, ?,?, ?, ?,?,?)");
         mysqli_stmt_bind_param($stmtAddpost,"ssissssssi",$post_title,$post_author,$post_category_id,$post_comment_count,$post_status,$post_image,$post_date,$post_content,$post_tags,$post_views);
         mysqli_stmt_execute($stmtAddpost);
         if(!$stmtAddpost){
         die('QUERY FAILED'. mysqli_error($connection));
         
          }
          $cool="<p class='text-primary' style=';font-weight: bold;'  >Post created</p>";
        }
         ?>

         
         <!-- <textarea name="post_content" id="editor" row="10" class="form-control" placeholder="Post Content" >
         </textarea> -->
        
       
         <div class="form-group">
      <select name="post_category_id" id="" required>
          <option value="" disabled>POST RELATED TO :</option>
          <option value="default" >default</option>

      <?php 
      $categoriesquery ="SELECT * FROM favourites WHERE user_favourites  = '".$_SESSION['username']."' ORDER BY fav_id ";
      $select_categories=mysqli_query($connection, $categoriesquery);
      while ($row = mysqli_fetch_assoc($select_categories))
      {
      $fav_id = $row["fav_id"];
      $fav_name = $row["fav_name"];
      echo "<option value='".$fav_id."'> ".$fav_name ."</option>";
      }

      ?>
      </select>

     </div>  
 <!-- <textarea  class="ckeditor"></textarea> -->
 
 <div class="form-group">
    <textarea class="form-control" id="exampleTextarea" name="post_content"cols="10" rows="5" charswidth="23"></textarea>
  </div>
  <style>
  #exampleTextarea {
  resize: vertical;
 font: normal 14px verdana;
 line-height: 25px;
 padding: 2px 10px;
 border: solid 1px #ddd;
 }
  </style>
  <?php include "upload_file.php";?>

<?php uploadfile(); ?>


<!-- <input type="file" size="60" name="image"> -->
<br>

         

         <button type="submit"  name="submit" class="btn btn-primary">Post</button>

        </form>
          <script>
        
            CKEDITOR.replace( 'editor1', {
  extraPlugins: 'imageuploader'
});
    </script> 
      </div>
      <?php 
                if(isset($cool))
                {
                    echo $cool;
                }
                ?>
                <?php
            

            $per_page = 3;


            if(isset($_GET['page'])) {


            $page = $_GET['page'];

            } else {


                $page = "";
            }


            if($page == "" || $page == 1) {

                $page_1 = 0;

            } else {

                $page_1 = ($page * $per_page) - $per_page;

            }


         if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {


        $post_query_count = "SELECT * FROM posts";


         } else {

         $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";

         }   

        $find_count = mysqli_query($connection,$post_query_count);
        $count = mysqli_num_rows($find_count);

        if($count < 1) {


            echo "<h1 class='text-center'>No posts available</h1>";




        } else {


        $count  = ceil($count /$per_page);



                
                $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
                $select_all_posts_query = mysqli_query($connection,$query);
                
                $query = "SELECT * FROM posts WHERE post_status ='published' ORDER BY post_id DESC LIMIT $page_1,5  ";
                $select_all_posts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_all_posts))
                {
                 $post_id =  $row['post_id'];
                 $post_title =  $row['post_title'];
                 $post_category = $row['post_category'];
                 $post_author = $row['post_author'];
                 $post_date =$row['post_date'];
                 $post_image =$row['post_image'];
                 $post_content =substr($row['post_content'],0,1000);
                 $post_tags =$row['post_tags'];
                 $post_comment_count =$row['post_comment_count'];
                 $post_status =$row['post_status'];
                 $post_views_count =$row['post_views_count'];
                 $post_likes = $row['post_likes'];

                 ?>
                <!-- First Blog Post -->
               
              
                <div class="media" id="divpost<?php echo $post_id; ?>">
          
                   
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
                     
                <!-- Delete post in index page -->
                <div  style="float:right">
                    <?php if($post_author === $_SESSION['username']) { ?>

                <form method="post" style="display: inline-block">

                <input type="hidden" name="post_id" value="<?php echo $post_id ?>"><p>
                <button name="delete" class="btn-sm" type="submit" style="border: none;background-color: transparent;"> 
                <span class="glyphicon glyphicon-trash text-danger" ></span>
                </button>

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

                                
                        </li><hr> <?php } ?>
                      
                        
                       
                      
                    
                </div>
              
                <p class="lead">
                
                    
                <small>
                  <a style="margin-left:15px" href="author_posts.php?author=<?php echo $post_author?>&p_id=<?php echo $post_id?>"><?php echo $post_author?></a>
                  </small>
                <small>
                 <h5><span class="glyphicon glyphicon-time"> Posted on <?php echo $post_date?></span></h5>
                </small>
                </p> 
                
                <p><a href="post.php?p_id=<?php echo $post_id ?>"><?php echo "<h4>".$post_category."</h4>" ?></a></p> 
                <?php echo $post_content; if(isset($post_image)){
                if(!empty($post_image)){ ?> 

                <a href="post.php?p_id=<?php echo $post_id ?>">
                <img class="img-responsive" style="width: 800px; border:0.01px solid black" src="<?php echo 'images/'.$post_image  ?>" alt="">
                </a>
                <?php  } } ?>

                <br>     <br>
                <?php
                if(isset($_POST['insertcomment'.$post_id])) {
               
                $usercomment = $_SESSION['username'];
                $comment_email = $_SESSION['Email'];                            
                $comment_content = mysqli_real_escape_string($connection,$_POST['comment']);              
                $comment_status = 'approved';
                $comment_date = date("F j, Y, g:i a");
                $insertcomment = mysqli_prepare($connection,"INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) VALUES (?,?,?,?,?,?)");
                mysqli_stmt_bind_param($insertcomment,"isssss",$post_id,$usercomment,$comment_email,$comment_content,$comment_status,$comment_date);
                mysqli_stmt_execute($insertcomment);
                if(!$insertcomment) {
                    die("QUERY NOT WORK".mysqli_error($connection));
                }

                $postcomment_count = mysqli_prepare($connection,"UPDATE posts SET post_comment_count = post_comment_count + ? WHERE post_id = ? ");
                $Add_one= 1;
                mysqli_stmt_bind_param($postcomment_count,"ii", $Add_one,$post_id);
                mysqli_stmt_execute($postcomment_count);
                if(!$postcomment_count) {
                    die("QUERY NOT WORK".mysqli_error($connection));
                }
                $locationpost= "index.php#divpost".$post_id;
                header("Location:$locationpost");
                ?>
           <script>
            $(document).ready(function(){
                $("#div<?php echo $post_id; ?>").show();
            )}
           </script>
                <?php
            
                }
         
                

                ?>
                

                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <script>
                $(document).ready(function(){
                $("#div<?php echo $post_id; ?>").hide();
                $("#hide<?php echo $post_id; ?>").click(function(){
                $("#div<?php echo $post_id; ?>").hide();
                $("#show<?php echo $post_id; ?>").show();
                });
                $("#show<?php echo $post_id; ?>").click(function(){
                $("#div<?php echo $post_id; ?>").show();
                $("#show<?php echo $post_id; ?>").hide();
                    });
                });
                </script>
                 <!-- <form>
                <input type="text" name="comment">
                <button type="submit" name="insertcomment"></button>
                </form> -->
           
                <div id="div<?php echo $post_id; ?>" class="input-group" style="width:100%;">
                <form action="" method="post" >
                <br>    
                <div class="input-group">
                
                <input id="clickinput" name="comment" type="text" class="form-control cmnt" placeholder="write a comment">
                <style>
               
                .cmnt {
                border-color:transparent;
                border-bottom:none;
                box-shadow:none;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0),0 0 8px rgba(255, 255, 255, 0);

                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0),0 0 8px rgba(102, 175, 233, 0);  
                border-bottom: 1px solid aliceblue;          
                }
                .cmnt:focus {

                border-color: transparent;
                outline: 0;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0),0 0 8px rgba(102, 175, 233, 0);
                border-bottom: 1px solid #3B5998;
                }
        
                
                </style>
   
                <span class="input-group-btn" >
                <button id="clckthebtn" type="submit" name="insertcomment<?php echo $post_id?>" class="btn btn-default cmnt2" style="border-radius:50%; margin-left:-20px;z-index:9;"><span style="color:#3B5998;" class="glyphicon glyphicon-send"></span> </button>

                </span>
                </form>
                <button type="button" class="btn btn-default" style="float:right;display:inline-block" id="hide<?php echo $post_id; ?>"><span class="text-danger glyphicon glyphicon-remove"></span></button>

                </div>
                </div>
                <button type="button" class="btn btn-default" id="show<?php echo $post_id; ?>">
                <span class="glyphicon glyphicon-comment "></span> Comment</button>
                
                </div>

                <hr>
                <?php 
                $comment_id = "";
                $row_user_comment="";
                $commentcount = mysqli_prepare($connection,"SELECT * FROM comments WHERE comment_post_id = ? ");
                mysqli_stmt_bind_param($commentcount,"i",$post_id);
                mysqli_stmt_execute($commentcount);
                if(!$commentcount) {
                    die("ERROE IN QUERY".mysqli_error($commentcount));
                }
                $result = mysqli_stmt_get_result($commentcount);
                while ( $rowcomment = $result->fetch_array()) {
                    $comment_id = $rowcomment['comment_id'];
                    $row_user_comment =  $rowcomment['comment_post_id'];
                }
                $Arrayofcomments = [$comment_id,$row_user_comment];
                ?> 
                           <?php if($post_likes > 0 ) { ?> 
                <span  class="glyphicon glyphicon-thumbs-up"></span>
              <?php echo $post_likes;?><?php } ?>&ensp;&ensp;&ensp;&ensp;
                <?php if(in_array($post_id, $Arrayofcomments)){

               if(isset($post_comment_count)) { 
                    if($post_comment_count == 1) {
                        ?> 
                    <span class="glyphicon glyphicon-comment"></span>
              <?php 
                    echo  $post_comment_count." "."comment";
                    }
                    else if ($post_comment_count > 1) {
                        ?> 
                    <span class="glyphicon glyphicon-comment"></span>
              <?php 
                        echo  $post_comment_count." "."comments";
                    
                    } 
                }
                    
                    
                    ?> 
                    
                <button id="showhidediv<?php echo $post_id; ?>" class="class-style"><span class="glyphicon glyphicon-chevron-down"></span></button>
                <button id="hidediv<?php echo $post_id; ?>" class="class-style"> <span class="glyphicon glyphicon-chevron-up"></span></button>
                <?php } ?>
                <style>
                .class-style
                {
                    border:0px solid transparent;
                    background-color:transparent;
                    outline:none;
                    float:right;
                }
                </style>
                <div style="width:100%;height:auto" id="divcomment<?php echo $post_id; ?>">                

                <script>
                $(document).ready(function(){
                $("#divcomment<?php echo $post_id; ?>").hide();
                $("#hidediv<?php echo $post_id; ?>").hide();
                


                $("#showhidediv<?php echo $post_id; ?>").click(function(){
                $("#divcomment<?php echo $post_id; ?>").show();
                $("#showhidediv<?php echo $post_id; ?>").hide();
                $("#hidediv<?php echo $post_id; ?>").show();

                });



                $("#hidediv<?php echo $post_id; ?>").click(function(){
                $("#divcomment<?php echo $post_id; ?>").hide();
                $("#showhidediv<?php echo $post_id; ?>").show();
                $("#hidediv<?php echo $post_id; ?>").hide();
                });
             
                });
                </script>


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

                <div class="media" >

                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="" style="border-radius: 50%; height:50px">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small ><?php  echo "<br>posted in ".$comment_date."<br>"?></small>
                        </h4> 
                       <h4><?php echo $comment_content;?> </h4> 


                        </div>
                        
                     
                </div>
                <hr>

                <?php } ?>



                </div>
                
                </div>

                <?php }  }  }
                else {
                    ?> 
               


                    <style>
                    body {
               
                            background-image: url(https://dslv9ilpbe7p1.cloudfront.net/_SwXTyfgYjpcmjxJh7xWsQ_store_header_image); 
                            
                            background-repeat:no-repeat;
                            background-size:cover; 
                            padding-top: 70px; 
                            overflow-x:hidden;  
                          }
                          .col-md-4
                          {
                            margin: auto;
                            
                            border: 0px solid ;
                            padding: 10px; 
                        }
                        
                       
                    </style>

                    <?php 
                }
                ?>


            </div> 
                

            <!-- Blog Sidebar Widgets Column -->
            <?php 
include "includes/sidebar.php";
?>
            
        </div>
        <!-- /.row -->
        <?php if(isset($_SESSION['username'])) {?>
        <ul class="pager">
        <?php 

$number_list = array();


for($i =1; $i <= $count; $i++) {

?>

<?php 
if($i == $page) {

     echo "<li '><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";


}  else {

    echo "<li '><a href='index.php?page={$i}'>{$i}</a></li>";




 

}

}

 ?>
    
</ul>
<?php  }
include "includes/footer.php";
?>

        
