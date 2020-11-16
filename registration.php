<?php use Pusher\Pusher; ?>

<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<?php ob_start(); ?>

    <!-- Navigation -->
<?php include "includes/navigation.php";?>
<?php include "includes/functions.php";

require __DIR__ . '/vendor/autoload.php';

$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv->load();

$options = array(
  'cluster' => 'eu',
  'useTLS' => true
);


$pusher = new Pusher(getenv('APP_KEY'), getenv('APP_SECRET'), getenv('APP_ID'), $options); 
// $pusher = new Pusher\Pusher(
//   'e8b74b284b8bffaa6f10',
//   'ffc6da4b885c31232c90',
//   '630935',
//   $options
// );

if (isset($_SESSION['username'])) { 
    
    header("Location:index.php"); } 
    else if(!isset($_SESSION['username'])) {
    ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">          
          <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $username  = trim($_POST['username']);
            $email     = trim($_POST['email']);
            $firstname = trim($_POST['firstname']);
            $lastname  = trim($_POST['lastname']);
            $password  = trim($_POST['password']);
            $user_role = 'Subscriber';
            
             $erorr = [
                'username'=>'',
                'email'=>'',
                'firstname'=>'',
                'lastname'=>'',
                'password'=>''
            ];
            if(strlen($username) < 4)
            {
               $erorr['username']='Username needs to be longer';
            }
            if(strlen($username) >  9)
            {
               $erorr['username']='Username between 4 and 9 characters';
            }
            if($username=='')
            {
                $erorr['username']='Username can not be empty';
            }
            if(username_exits($username))
            {
                  $erorr['username']='Username already exists';
            }
            if($email=='')
            {
                  $erorr['email']='Email can not be empty';
            }
            if(useremail_exits($email))
            {
                 $erorr['email']='Email already exists';
            }
            if($firstname=='')
            {
                  $erorr['firstname']='Firstname can not be empty';
            }
            if(strlen($password) < 4)
            {
                 $erorr['password']='Password needs to be longer';
            }
            if($password=='')
            {
                 $erorr['password']='Password can not be empty';
            }
            if($lastname=='')
            {
                  $erorr['lastname']='Lastname can not be empty';
            }
           
            foreach ($erorr as $key => $value) {
                if(empty($value))
                {
                    unset($erorr[$key]);
                }
            }//foreach        
            
            if(empty($erorr))
            {
                $correct = "Registration Completed";
                register_user($username,$email,$firstname,$lastname,$password,$user_role);

                
        $data['message'] = $username;

        $pusher->trigger('notifications', 'new_user', $data);

                 login_user($username, $password);
                 header("Location:index.php");
            }
        }


        
        ?>
      
            <div class="col-md-12    ">
                <div class="form-wrap">
                <h3 class="text-primary text-center" id="mouse-hover" style="border:.1px solid;width:200px;padding:10px 15px;font-weight:bold;margin:auto"><p>Free Sign Up</p></h3>
                <style>
                #mouse-hover:hover {
                    background-color:#337ab7;
                    color:white;
                }
                .input-style
                    {
                        border-radius:0px;

                        outline:none;
                        background-color:#fcfcfc4d;
                        width:60%;
                        height:50px;
                        margin:auto;
                    }
                    .input-style:hover {
                        border:1px solid #337ab7;
                    }
                        .submit-style:hover {
                            background-color:white  !important;
                            color:#337ab7 !important;
                            border:1px solid #337ab7;

                        }
                        .error-alert{
                            width:60%; 
                            margin:auto;
                        }

                </style>                
                <p class="text-success"><?php echo isset($correct) ? $correct : '' ?></p>

                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                        <p class="text-danger bg-danger error-alert"><?php echo isset($erorr['username']) ? $erorr['username'] : '' ?></p>

                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control input-style" placeholder=" Username"
                            autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>"
                            >
                        </div>
                         <div class="form-group">
                         <p class="text-danger bg-danger error-alert"><?php echo isset($erorr['email']) ? $erorr['email'] : '' ?></p>

                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control input-style" placeholder="Email"
                            autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>"
                            >
                        </div>
                        <div class="form-group">
                        <p class="text-danger bg-danger error-alert"><?php echo isset($erorr['firstname']) ? $erorr['firstname'] : '' ?></p>

                            <label for="firstname" class="sr-only">firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control input-style" placeholder="Firstname"
                            autocomplete="on" value="<?php echo isset($firstname) ? $firstname : '' ?>"
                            >
                        </div>
                        <div class="form-group">
                        <p class="text-danger bg-danger error-alert"><?php echo isset($erorr['lastname']) ? $erorr['lastname'] : '' ?></p>

                            <label for="lastname" class="sr-only">lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control input-style" placeholder="Lastname"
                            autocomplete="on" value="<?php echo isset($lastname) ? $lastname : '' ?>"
                            >
                        </div>
                         <div class="form-group">
                         <p class="text-danger bg-danger error-alert"><?php echo isset($erorr['password']) ?  $erorr['password'] : '' ?></p>

                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control input-style" placeholder="Password">
                            <br>

                        </div>
                
                        <input type="submit" name="submit" id="btn-login " class="btn btn-custom btn-lg btn-block text-center submit-style" value="JOIN US" style="background-color:#3B5998;border-radius:0px;color:white;font-weight:bold;width:40%;margin:auto">
                    </form>
                 
                 
                </div>      
 </div>

           <br><br>
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
    }
?>

        
