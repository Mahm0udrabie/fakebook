
    <?php
function redirect($location){
    header("Location:" . $location);
    exit;
}

function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;
}
function isLoggedIn(){
   if(isset($_SESSION['user_role'])){
        return true;
    }
   return false;
}
function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }
}
function escape($string) {
global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}
    global $connection;
    $session = session_id();
    $time = time();
    $time_out_in_seconds =60;
    $time_out = $time - $time_out_in_seconds;
    $queryusers = "SELECT * FROM users_online WHERE session = '$session' ";
    $SEND_QUERY = mysqli_query($connection ,$queryusers) ;
    $count = mysqli_num_rows($SEND_QUERY);
if ($count == NULL) {
    mysqli_query($connection ,"INSERT INTO users_online (session,time) VALUES ('$session','$time')");
    }
    else {
        mysqli_query($connection ,"UPDATE users_online SET time ='$time' WHERE session = '$session' ");
    }
    $queryCountofusers =   mysqli_query($connection ,"SELECT * FROM users_online WHERE time > '$time_out' ");
    $countofusers= mysqli_num_rows($queryCountofusers);
    $usersonlinecount= "Online Users : ".$countofusers;
    $_SESSION['usersonlinecount'] = $usersonlinecount;
    $_SESSION['usersonlinecount'] = $usersonlinecount;
function catch_errors($result) {
    global $connection;
    if(!$result) {
    die("query not work" . mysqli_error($connection));
        }
    }
    function username_exits($username){
    global $connection;
    $querydub = "SELECT username FROM users WHERE username= '$username'";
    $resultdub=mysqli_query($connection,$querydub);
    if(mysqli_num_rows($resultdub) >0){
        return true;
    }
    else{
        return false;
    }

    }
    function useremail_exits($email){
    global $connection;
    $querydube = "SELECT user_email FROM users WHERE user_email= '$email'";
    $resultdube=mysqli_query($connection,$querydube);
    if(mysqli_num_rows($resultdube) >0){
        return true;
    }
    else{
        return false;
    }

    }   
    function register_user($username,$email,$firstname,$lastname,$password,$user_role) { 
     global $connection;

     $username  = mysqli_real_escape_string($connection,$username);
     $email     = mysqli_real_escape_string($connection,$email);
     $firstname = mysqli_real_escape_string($connection,$firstname);
     $lastname  = mysqli_real_escape_string($connection,$lastname);
     $password  = mysqli_real_escape_string($connection,$password);     
     $password = password_hash($password,PASSWORD_BCRYPT,array('cost'=>12));

     $insertuser= "INSERT INTO users (username,password,user_firstname,user_lastname,user_email,user_role)
     VALUES('$username','$password','$firstname','$lastname','$email','$user_role')";
     $Sendingquery = mysqli_query($connection, $insertuser);

     if(!$Sendingquery){
        die("<script>alert('query of insert user not work')</script>".mysqli_error($connection));
    }
    

    

    }
        function login_user($username,$password)
        {
        global $connection;
        $username =  trim($username);
        $password =  trim($password);
        $username =  mysqli_real_escape_string($connection, $_POST['username']);
        $password =  mysqli_real_escape_string($connection, $_POST['password']);
        $sqllogin =  " SELECT * FROM users WHERE username= '$username' ";
        $selectquery = mysqli_query($connection , $sqllogin);
        if(!$selectquery)
        {
            die( " QUERY NOT WORK" . mysqli_error($connection));
        } 

        while ($row=mysqli_fetch_assoc($selectquery)) {
        $user_id        = $row['user_id'];
        $usernamelogin  = $row['username'];
        $user_password  = $row['password'];
        $useremail      = $row['user_email'];
        $user_firstname = $row['user_firstname'];
        $user_lastname  = $row['user_lastname'];
        $user_image     = $row['user_image'];
        $user_role      = $row['user_role'];
        }
        if(password_verify($password, $user_password)  )  {
        $_SESSION['username']   = $usernamelogin;
        $_SESSION['password']   = $user_password;
        $_SESSION['firstname']  = $user_firstname;
        $_SESSION['lastname']   = $user_lastname;
        $_SESSION['Email']      = $useremail;
        $_SESSION['user_image'] = $user_image;
        $_SESSION['user_role']  = $user_role;
        header("Location:../index.php");
        }
        else {
        $valild = "username or password is incorrect";
        $_SESSION['wrongvalue'] = $valild; 
        header("Location: ../index.php");
        }

        }
            
function insert_favourites()
{
global $connection;
if(isset($_POST["submit"]))
{
$fav_name = $_POST["cat_title"];
if ($fav_name == "" || empty($fav_name))
{
echo "<h4 style='color:red;'>This field should not be empty!!</h4>";
}
else
{
$fav_code = $fav_name.$_SESSION['username'];
$queryfavourites = mysqli_prepare($connection,"INSERT INTO  favourites(fav_name,user_favourites,fav_code) VALUES(?,?,?)" );
mysqli_stmt_bind_param($queryfavourites,'sss',$fav_name,$_SESSION['username'],$fav_code);
mysqli_stmt_execute($queryfavourites);
catch_errors($queryfavourites);

}

} 

}

function select_favourites()
{
global $connection;
$favouritesquery ="SELECT * from favourites WHERE user_favourites = '".$_SESSION['username']."' ORDER BY fav_id";
$select_favourites=mysqli_query($connection,$favouritesquery);
catch_errors($select_favourites);

while ($row = mysqli_fetch_assoc($select_favourites))
{
$fav_id = $row["fav_id"];
$fav_name= $row["fav_name"];
echo " <tr><td>{$fav_id}</td>";
echo "<td>{$fav_name}</td>";
echo " <td><a onclick=\"javascript: return confirm('Are you sure you want to delete'); \"  href='interests.php?delete={$fav_id}' class='btn btn-info btn-sm'>
<span class='glyphicon glyphicon-trash '></span> Trash 

</a></td>";
echo " <td><a href='interests.php?edit={$fav_id}' class='btn btn-info btn-sm'>
<span class='glyphicon glyphicon-edit'></span> Edit
</a></td>";
}
} 



function delete_favourites()
{
    if($_SESSION['user_role'] == 'Admin'  || !empty($_SESSION['user_role']))
{
    if(isset($_SESSION['username']) || !empty($_SESSION['username']))
    {
        global $connection;
        if (isset($_GET['delete']))
        {
        $the_fav_id =  $_GET['delete'];
        $query_fav ="DELETE FROM favourites WHERE fav_id = {$the_fav_id} ";
        $delete_query=mysqli_query($connection ,$query_fav);
        catch_errors($delete_query);
        
        header("Location: interests.php");
        }
    }
} 
else
{
    header("Location:index.php"); 

}


}



function update_favourites()
{
global $connection;
if(isset($_GET['edit']))
{
$fav_edit=$_GET['edit'];
$Editquery ="SELECT * from favourites WHERE fav_id = {$fav_edit} ";
$update_favourites=mysqli_query($connection,$Editquery);
catch_errors($update_favourites);

while ($row = mysqli_fetch_assoc($update_favourites))
{
$fav_id = $row["fav_id"];
$fav_name = $row["fav_name"];
?>
<form action="" method="post">
<div class="form-group">
<label for="cat-title">Update Category</label>
<input value="<?php if (isset($fav_name)) {echo $fav_name;} ?>" type="text" class="form-control" name="cat_Update">
</div>
<div class="form-group">
<input class="btn btn-primary" type="submit" name="update" value="Update Category">
</div>

</form>
<?php 
if (isset($_POST['update']))
{
$update_fav=  $_POST['cat_Update'];
if ($update_fav== "" || empty($update_fav))
{
echo "<h4 style='color:red;'>This field should not be empty!!</h4>";
}
else
{
$update_query_fav ="UPDATE favourites SET fav_name = '$update_fav' WHERE fav_id = '$fav_id' ";     
$update_query=mysqli_query($connection ,$update_query_fav);
catch_errors($update_query);

header("Location: interests.php");
}
}
?>
<?php } } } ?>
