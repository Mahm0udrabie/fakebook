
<?php

function escape($string) {

    global $connection;
    
    return mysqli_real_escape_string($connection, trim($string));
    
    
    }
    

function users_online() {



    if(isset($_GET['onlineusers'])) {

    global $connection;

    if(!$connection) {

        session_start();

        include("../includes/db.php");

        $session = session_id();
        $time = time();
        $time_out_in_seconds = 05;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

            if($count == NULL) {

            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");


            } else {

            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");


            }

        $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $count_user = mysqli_num_rows($users_online_query);


    }






    } // get request isset()


}

users_online();


function catch_errors($result)
{
global $connection;
if(!$result)
{
die("query not work" . mysqli_error($connection));
}
}
function insert_categories()
{
global $connection;
if(isset($_POST["submit"]))
{
$cat_title = $_POST["cat_title"];
if ($cat_title == "" || empty($cat_title))
{
echo "<h4 style='color:red;'>This field should not be empty!!</h4>";
}
else
{
$query = "INSERT INTO  categories(cat_title) VALUES('$cat_title')";
$category_query=mysqli_query($connection,$query);
catch_errors($category_query);
}
}
}
function select_categories()
{
global $connection;
$categoriesquery ="SELECT * from categories ORDER BY cat_id";
$select_categories=mysqli_query($connection,$categoriesquery);
catch_errors($select_categories);

while ($row = mysqli_fetch_assoc($select_categories))
{
$cat_id = $row["cat_id"];
$cat_title = $row["cat_title"];
echo " <tr><td>{$cat_id}</td>";
echo "<td>{$cat_title}</td>";
echo " <td><a onclick=\"javascript: return confirm('Are you sure you want to delete'); \"  href='categories.php?delete={$cat_id}'>Delete </a></td>";
echo " <td><a href='categories.php?edit={$cat_id}'>Edit </a></td>";
}
} 
function delete_categories()
{
    if($_SESSION['user_role'] == 'Admin'  || !empty($_SESSION['user_role']))
{
    if(isset($_SESSION['username']) || !empty($_SESSION['username']))
    {
        global $connection;
        if (isset($_GET['delete']))
        {
        $the_cat_id =  $_GET['delete'];
        $query_cat ="DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query=mysqli_query($connection ,$query_cat);
        catch_errors($delete_query);
        
        header("Location: categories.php");
        }
    }
} 
else
{
    header("Location:../index.php"); 

}


}



function update_categories()
{
global $connection;
if(isset($_GET['edit']))
{
$cat_edit=$_GET['edit'];
$Editquery ="SELECT * from categories WHERE cat_id = {$cat_edit} ";
$update_categories=mysqli_query($connection,$Editquery);
catch_errors($update_categories);

while ($row = mysqli_fetch_assoc($update_categories))
{
$cat_id = $row["cat_id"];
$cat_title = $row["cat_title"];
?>
<form action="" method="post">
<div class="form-group">
<label for="cat-title">Update Category</label>
<input value="<?php if (isset($cat_title)) {echo $cat_title;} ?>" type="text" class="form-control" name="cat_Update">
</div>
<div class="form-group">
<input class="btn btn-primary" type="submit" name="update" value="Update Category">
</div>

</form>
<?php 
if (isset($_POST['update']))
{
$update_cat =  $_POST['cat_Update'];
if ($update_cat == "" || empty($update_cat))
{
echo "<h4 style='color:red;'>This field should not be empty!!</h4>";
}
else
{
$update_query_cat ="UPDATE categories SET cat_title = '$update_cat' WHERE cat_id = '$cat_id' ";     
$update_query=mysqli_query($connection ,$update_query_cat);
catch_errors($update_query);

header("Location: categories.php");
}
}
?>
<?php } } }

function is_admin($username){
    global $connection;
    $queryadmin = "SELECT user_role FROM users WHERE username= '$username'";
    $resultadmin=mysqli_query($connection,$queryadmin);
    catch_errors($resultadmin);
    $rowadmin=mysqli_fetch_array($resultadmin);
    if($rowadmin['user_role'] == 'Admin'){
        return true;
        
    }
    else{
        header("Location:../includes/logout.php");
    }

}
?> 
