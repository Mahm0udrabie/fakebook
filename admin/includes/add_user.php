
<?php
   if(isset($_POST['add_user'])) 
   {
   
$user_firstname       = mysqli_real_escape_string($connection,$_POST['user_firstname']);
$user_role      = mysqli_real_escape_string($connection,$_POST['user_role']);
$user_lastname    = mysqli_real_escape_string($connection,$_POST['user_lastname']);
$username    = mysqli_real_escape_string($connection,$_POST['username']);
$Email      = mysqli_real_escape_string($connection,$_POST['Email']);
$password      = mysqli_real_escape_string($connection,$_POST['password']);
$user_image        = $_FILES['image']['name'];
$user_image_temp   = $_FILES['image']['tmp_name']; 
move_uploaded_file($user_image_temp, "../images/$user_image");
$password = password_hash($password,PASSWORD_BCRYPT,array('cost'=>12));




$query = mysqli_prepare($connection," INSERT INTO users(user_firstname,user_role,user_lastname,username,user_email,password,user_image) VALUES (?,?,?,?,?,?,?)");     
mysqli_stmt_bind_param($query,'sssssss',$user_firstname,$user_role,$user_lastname,$username,$Email,$password,$user_image);
// $Adduser = mysqli_query($connection, $query);  
mysqli_stmt_execute($query);

catch_errors($query);
echo "<p class='bg-success' style=' font-weight: bold;'  >User created : <a href='users.php'>view users</a></p>";
   }
?>
    <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="first name">First Name</label>
          <input type="text" class="form-control" name="user_firstname" required="required">
      </div> 

      <div class="form-group">
         <label for="last name">last name</label>
          <input type="text" class="form-control" name="user_lastname" required="required">
      </div> 
      <div class="form-group">
          <select class="form-control" name="user_role" required="required">
             <option value="Admin" selected="selected" >Admin</option>
          <option value="Subscriber" >Subscriber</option>
          </select>
      </div>  
      <div class="form-group">        
   <label for="post_image">Upload Your Image</label><br>
  


         <input type="file"  name="image" value="">
     </div>
      <div class="form-group">
         <label for="username">username</label>
          <input type="text" class="form-control" name="username" required="required">
      </div>   

      <div class="form-group">
         <label for="Email">Email</label>
          <input type="email" class="form-control" name="Email" required="required">
      </div>  
      <div class="form-group">
         <label for="password">password</label>
          <input type="password" class="form-control" name="password" required="required">
      </div>   
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="add_user" value="Add User">
      </div>
      

</form>
    