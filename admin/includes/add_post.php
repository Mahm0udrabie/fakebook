
<?php
   if(isset($_POST['create_post'])) 
   {
   
    $post_title        = $_POST['title'];
    $post_author       = $_SESSION['username'];
    $post_category_id  = $_POST['post_category_id'];
    $post_comment_count= 0;
    $post_status       = $_POST['post_status'];
    $post_date         = date("F j, Y, g:i a");
    $post_image        = uniqid().$_FILES['image']['name'];
    $post_image_temp   = $_FILES['image']['tmp_name'];
    $post_content      = mysqli_real_escape_string($connection,$_POST['post_content']);
    $post_tags         = mysqli_real_escape_string($connection,$_POST['post_tags']);
    $post_views = 0;
    move_uploaded_file($post_image_temp, "../images/$post_image" );
    // $query = "INSERT INTO posts (post_title,post_author,post_category_id,post_comment_count,post_status,post_date,post_image,post_content,post_tags) ";
    // $query .= " VALUES('$post_title','$post_author','$post_category_id','$post_comment_count','$post_status','$post_date','$post_image','$post_content','$post_tags') ";     
    // $create_post_query = mysqli_query($connection, $query);  
    // catch_errors($create_post_query);
    $stmtAddpost = mysqli_prepare($connection,"INSERT INTO posts (post_title,post_author,post_category_id,post_comment_count,post_status,post_date,post_image,post_content,post_tags,post_views_count) VALUES (?,?, ?, ?,?, ?, ?,?, ?, ?)");
    // $stmt = $mysqli->prepare($query);
    mysqli_stmt_bind_param($stmtAddpost,"sssssssssi",$post_title,$post_author,$post_category_id,$post_comment_count,$post_status,$post_date,$post_image,$post_content,$post_tags,$post_views);
    mysqli_stmt_execute($stmtAddpost);
    
    
    if(!$stmtAddpost){
    die('QUERY FAILED'. mysqli_error($connection));
    
     }
    echo "<p class='bg-success' style=';font-weight: bold;'  >Post created : <a href='./posts.php'>view posts</a></p>";
   }
    

    
    
?>

    <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="title">
      </div> 

        <div class="form-group">
      <label for="category">Category</label>
      <select name="post_category_id" id="" required>
      <?php 
      $categoriesquery ="SELECT * from categories ORDER BY cat_id ";
      $select_categories=mysqli_query($connection, $categoriesquery);
      while ($row = mysqli_fetch_assoc($select_categories))
      {
      $cat_id = $row["cat_id"];
      $cat_title = $row["cat_title"];
      echo "<option value='".$cat_id."'>".$cat_id." - " .$cat_title ."</option>";
      }
      ?>
         </div>
      </select>
     </div>  
           
        
       <!-- </select>
      
      </div> -->


       <!-- <div class="form-group">
       <label for="users">Users</label>
       <select name="post_user" id=""> 
       <option value='write'>ololl</option>
       <option value='Ahmed'>ololl</option>  -->


           
<?php

        // $users_query = "SELECT * FROM users";
        // $select_users = mysqli_query($connection,$users_query);
        
        // confirmQuery($select_users);


        // while($row = mysqli_fetch_assoc($select_users)) {
        // $user_id = $row['user_id'];
        // $username = $row['username'];
            
            
        //     echo "<option value='{$username}'>{$username}</option>";
         
            
        // }

?>
           
<!--         
       </select>
      
      </div>  -->


   <!-- <div class="form-group">
      <label for="post_author">post author</label>
      <select name="post_author" id="" required>
      <?php 
      // $usersquery ="SELECT * from users ORDER BY user_id ";
      // $select_usersname=mysqli_query($connection, $usersquery);
      // while ($rowusers = mysqli_fetch_assoc($select_usersname))
      // {
      // $user_id = $rowusers["user_id"];
      // $username= $rowusers["username"];
      // echo "<option value='".$username."'>". $user_id." - " .$username ."</option>";
      // }
      ?>
         </div> 
      </select>
     </div>  -->


      <!-- <div class="form-group">
         <label for="title">Post Author</label>
          <input type="text" class="form-control" name="post_author">
      </div> 
       -->
      

      <div class="form-group">
         <select name="post_status" id="">
             <option value="draft">Post Status</option>
             <option value="published">Published</option>
             <option value="draft">Draft</option>
         </select>
      </div> 

      
      
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>      
 
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea name="post_content" id="editor" class="form-control">
         <!-- <textarea  name="post_content" id="body" cols="" rows="10"> -->
         </textarea>     <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>

</form>
    