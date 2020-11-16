<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
<?php 
if(isset($_POST['submit'])) {

$name         =mysqli_real_escape_string($connection,$_POST['name']);
$email        =mysqli_real_escape_string($connection,$_POST['email']);
$subject    = mysqli_real_escape_string($connection,$_POST['subject']);
$body       = mysqli_real_escape_string($connection,$_POST['body']);

$stmtcontact = mysqli_prepare($connection,"INSERT INTO feedback (contact_name,contact_email,contact_subject,contact_body) VALUES(?,?,?,?)");

mysqli_stmt_bind_param($stmtcontact,"ssss",$name,$email,$subject,$body);
mysqli_stmt_execute($stmtcontact);



}


?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="form-wrap">
                <h1>Contact</h1>
                <?php 
              if(isset($stmtcontact->num_rows)){
                    echo "<h3 class='text-primary'>Message Sent</h3>";  
                }
                        
                ?>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                       
                    <div class="form-group">
                            <label for="name" class="sr-only">name</label>
                            <input type="name" name="name" id="name" class="form-control" placeholder="Enter your Name">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your Subject">
                        </div>
                         <div class="form-group">
                           
                           <textarea class="form-control" name="body" id="body" cols="20" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
            <?php include "includes/sidebar.php"; ?>

        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
</div>
<?php include "includes/footer.php";?>
