<!-- <?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
        <?php
        if(isset($_POST['submit']))
        {
            $username=mysqli_real_escape_string($connection, $_POST['username']);
            $email = mysqli_real_escape_string($connection,$_POST['email']);
            $firstname=mysqli_real_escape_string($connection, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
            $password = mysqli_real_escape_string($connection,$_POST['password']);
            $user_role =' Subscriber';
            $password = password_hash($password,PASSWORD_BCRYPT,array('cost'=>12));
          
            if(!empty($username) && !empty($email) && !empty($password) && !empty($firstname) && !empty($lastname))
            {
             $insertuser= "INSERT INTO users (username,password,user_firstname,user_lastname,user_email,user_role)
             VALUES('$username','$password','$firstname','$lastname','$email','$user_role')";
             $Sendingquery = mysqli_query($connection, $insertuser);
             if(!$Sendingquery)
            {
                die("<script>alert('query of insert user not work')</script>".mysqli_error($connection));
            }
               $messageregister ="<h3><p style='color:green;'>Registration Completed</p></h3>";
            }
            else
            {
                $message ="<h3><p style='color:red;'>fields can not be empty</p></h3>";
            }
        }

        
        ?>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 ">
                <div class="form-wrap">
                <h1>Register</h1>
                <?php if(isset($message)){ echo  "  ".$message; } ?>
                <?php if(isset($messageregister)){ echo  "  ".$messageregister; } ?>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="sr-only">firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter lastname">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>       </div> <!-- /.col-xs-12 --> <?php 
include "includes/sidebar.php";
?>
        </div> <!-- /.row -->
     
    </div> <!-- /.container -->
</section>


        <hr>

    
        

<?php include "includes/footer.php";?> -->
