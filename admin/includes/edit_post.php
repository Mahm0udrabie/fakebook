<?php

if(isset($_GET['p_id']))
{
  $edit_post = $_GET['p_id'];
}
$query_post = "SELECT * FROM posts  where post_id = '$edit_post' ";
$select_query = mysqli_query($connection ,$query_post);
while($postrow = mysqli_fetch_assoc($select_query))
{
    $post_id= $postrow['post_id'];
    $post_title = $postrow['post_title'];
    $post_author= $postrow['post_author'];
    $post_category_id= $postrow['post_category_id'];
    $post_status =$postrow['post_status'];
    $post_content =$postrow['post_content'];
    $post_image =$postrow['post_image'];
    $post_catrgory = $postrow['post_category'];
    // $post_comments = $postrow['post-comment'];
    $post_tags = $postrow['post_tags']; 
    $post_date = $postrow['post_date'];

}

if(isset($_POST['updatepost']))
{
    $post_title = $_POST['post_title'];
    $post_author= $_POST['post_author'];
    // $post_user= $postrow['post_user'];
    $post_status =$_POST['post_status'];
    $post_content =mysqli_real_escape_string($connection,$_POST['post_content']);
    $post_image        = $_FILES['image']['name'];
    $post_image_temp   = $_FILES['image']['tmp_name'];  
    $post_category_id = $_POST['post_category_id'];
    // $post_comments = $postrow['post_comment'];
    $post_tags = $_POST['post_tags']; 
    $post_date = date('d-m-y');
     move_uploaded_file($post_image_temp, "../images/$post_image");
    
     if(empty($post_image))
     {
         $queryofimage = "SELECT * FROM posts  WHERE post_id= '$edit_post'";
         $mysqliquery = mysqli_query($connection, $queryofimage);
         while($rowimage = mysqli_fetch_assoc($mysqliquery)){
         $post_image = $rowimage['post_image'];
         }
     }
    $query_update_post = " UPDATE posts  SET post_title = '$post_title', post_category_id ='$post_category_id' , post_status ='$post_status' , post_author = '$post_author' , post_content = '$post_content' , post_image='$post_image'  , post_tags = '$post_tags' , post_date = now() WHERE post_id = '$edit_post' ";
    $update = mysqli_query ($connection , $query_update_post);  
    catch_errors($update);
///////////
$select_postofcatogry="SELECT * FROM categories WHERE cat_id= '$post_category_id' ";
$select_postofcatogry_query=mysqli_query($connection ,$select_postofcatogry);
catch_errors($select_postofcatogry_query);
while($rowofSelect=mysqli_fetch_assoc($select_postofcatogry_query))
{
    $catTitle = $rowofSelect['cat_title'];
}

///////////
    $query_update_post_category = " UPDATE posts  SET post_category = '$catTitle' WHERE post_id = '$edit_post' ";
    $update_postcategory = mysqli_query ($connection , $query_update_post_category);  
    catch_errors($update_postcategory);
    echo "<p class='bg-success' style='font-weight: bold;'  >post has been edited: <a href='../post.php?p_id=$edit_post'>view post</a></p>";

}

?>
    <form action="" method="post" enctype="multipart/form-data">    
     <div class="form-group">
        <label for="title">Post Title</label>
         <input type="text" name="post_title" class="form-control" value="<?php echo $post_title ?>"  >
     </div> 
        <div class="form-group">
      <label for="category">Category</label>
      <select name="post_category_id" id="" required="required">
      <?php 
      $categoriesquery ="SELECT * from categories  order by cat_id";
      $select_categories=mysqli_query($connection,$categoriesquery);
      while ($row = mysqli_fetch_assoc($select_categories))
      {
      $cat_id = $row["cat_id"];
      $cat_title = $row["cat_title"];
      if($cat_id == $post_category_id)
      {
      echo "<option selected='selected'  value='".$cat_id ."'>" .$cat_title."</option>";
      }
      else 
      {
        echo "<option  value='".$cat_id ."'>" .$cat_title ."</option>";

      }
    }

      ?>
         </div>
      </select>
     </div> 
      <!-- <div class="form-group">
      <label for="users">Users</label>
      <select name="post_user" id=""> 
      <option value='write'>ololl</option>
      <option value='Ahmed'>ololl</option> 
      </select>
     </div>   -->
     <div class="form-group">
      <label for="category">users</label>
      <select name="post_author" id="" >
          <!-- <option selected="selected"  disabled="disabled">users</option> -->
         <option   value='<?=$post_author?>' selected="selected" ><?=$post_author?></option>
      <?php 
      $users_query ="SELECT * from users";
      $select_usresname=mysqli_query($connection, $users_query);
      while ($rowofusersname = mysqli_fetch_assoc($select_usresname))
      {
      $user_id = $rowofusersname["user_id"];
      $username = $rowofusersname["username"];
      $post_author;
      
      echo "<option   value='".$username ."'>".$user_id." - " .$username."</option>";
      }
      ?>
         </div>
      </select>
     </div> 





     <!-- <div class="form-group">
        <label for="title">Post Author</label>
         <input type="text" class="form-control" value="<?php //echo $post_author ?>" name="post_author">
     </div>  -->

  <div class="form-group">
  <label for="post status">post status</label>
          <select  name="post_status" >
          <option value="<?php echo $post_status; ?>" selected="selected" ><?php echo $post_status; ?></option>
          <?php 
          if($post_status == 'published')
          {
              echo "<option value='draft'>draft</option>";
          }else {
          ?>
             <option value="published" >published</option>
          <?php } ?>
          </select>
      </div>  

       <!-- <div class="form-group">
        <select name="post_status" id="" required="required" >
            <option selected="selected"  disabled="disabled" >Post Status</option>
            <option value="published" >Published</option>
            <option value="draft" >Draft</option>
        </select>
     </div>  -->
     
   <div class="form-group">        
   <label for="post_image">Post Image</label><br>
  
   <img  width="100" src='../images/<?php echo $post_image ?>'>


         <input type="file"  name="image" value="">
     </div>

     <div class="form-group">
        <label for="post_tags">Post Tags</label>
         <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>">
     </div>      
     <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control "name="post_content"   id="" cols="30" rows="10"><?php echo $post_content ?>
        </textarea>
     </div>
      <div class="form-group">
         <input class="btn btn-primary" type="submit" name="updatepost" value="update Post">
     </div>
</form>

<?php  ?>

   