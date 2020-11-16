<?php 
include "includes/admin_header.php" 
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                      
                    Welcome to Admin
                            <small><?php if(isset($_SESSION['username'])) {  echo $_SESSION['username']; } else {header("Location : ../index.php"); }  ?></small>
                        </h1>
<?php 
if(isset($_SESSION['username']))
{
$username = $_SESSION['username'];
$sqllogin= " SELECT * FROM users WHERE username= '$username' ";
$selectquery = mysqli_query($connection , $sqllogin);
if(!$selectquery)
{
die( " QUERY NOT WORK" . mysqli_error($connection));
} 
while ($row=mysqli_fetch_assoc($selectquery))
{
$user_id = $row['user_id'];
$usernamelogin=$row['username'];
$user_password=$row['password'];
$user_firstname=$row['user_firstname'];
$user_lastname=$row['user_lastname'];
$user_email =$row['user_email'];
$user_image=$row['user_image'];
$user_role =$row['user_role'];
}

}
if(isset($_POST['updatuser']))
{
$user_firstname       = mysqli_real_escape_string($connection,$_POST['user_firstname']);
$user_role      = mysqli_real_escape_string($connection,$_POST['user_role']);
$user_lastname    = mysqli_real_escape_string($connection,$_POST['user_lastname']);
$username    = mysqli_real_escape_string($connection,$_POST['username']);
$Email      = mysqli_real_escape_string($connection,$_POST['user_email']);
$user_image        = $_FILES['image']['name'];
$user_image_temp   = $_FILES['image']['tmp_name']; 
move_uploaded_file($user_image_temp, "../images/$user_image");

if(empty($user_image))
{
$queryofimage = "SELECT * FROM users  WHERE user_id = '$user_id '";
$mysqliquery = mysqli_query($connection, $queryofimage);
while($rowimage = mysqli_fetch_assoc($mysqliquery)){
$user_image = $rowimage['user_image'];
}
}
$query_update_user = " UPDATE users  SET user_firstname = '$user_firstname', user_lastname= '$user_lastname' , username ='$username' , user_role ='$user_role' , user_email = '$Email', user_image = '$user_image' ";
$query_update_user .= " WHERE user_id = '$user_id' ";
$updateuser = mysqli_query ($connection , $query_update_user);
catch_errors($updateuser);
header("Location: ../includes/logout.php");
}
?>
     <form action="" method="post" enctype="multipart/form-data">    
     
     
     <div class="form-group">
        <label for="first name">First Name</label>
         <input type="text" value="<?php echo  $user_firstname ?>" class="form-control" name="user_firstname" required="required">
     </div> 

     <div class="form-group">
        <label for="last name">last name</label>
         <input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname" required="required">
     </div> 
     <div class="form-group">
         <select  name="user_role" required="required">
         <option value="<?php echo  $user_role; ?>" selected="selected" ><?php echo $user_role; ?></option>
         <?php 
         if($user_role == 'Admin')
         {
             echo  "<option value='Subscriber'>Subscriber</option>";
         }else {
         ?>
            <option value="Admin" >Admin</option>
         <?php } ?>
         </select>
     </div>  
     <div class="form-group">        
  <label for="post_image">change Your Image</label><br>
 
  <img  width="100" src='../images/<?php echo  $user_image ?>'>


        <input type="file"  name="image" value="">
    </div>

     <div class="form-group">
        <label for="username">username</label>
         <input type="text" value="<?php echo $usernamelogin ?>" class="form-control" name="username" required="required">
     </div>   

     <div class="form-group">
        <label for="Email">Email</label>
         <input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email" required="required">
     </div>  
      <div class="form-group">
        <label for="password">password</label>
         <input type="password" value="<?php echo $user_password?>" class="form-control" name="password" required="required">
     </div>    
      <div class="form-group">
         <input class="btn btn-primary" type="submit" name="updatuser" value="Updat Profile">
     </div>
     

</form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>
