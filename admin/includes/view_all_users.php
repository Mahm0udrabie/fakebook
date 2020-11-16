
<table class="table table-bordered table-hover" style="text-align:center;" >
<style>
.table td {
   text-align: center;   
}
</style>
                        <thead >
                            <tr>
                                <th>ID</th>
                                <th>username</th>
                                <th>firstname</th>
                                <th>lastname</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>role</th>
                            </tr>
                        </thead>   
                        <tbody>

                        
<?php 
global $connection;
$query_users = "SELECT * FROM users";
$select_users = mysqli_query($connection ,$query_users);
catch_errors($select_users);

while($usersrow = mysqli_fetch_assoc($select_users))
{
    $user_id = $usersrow['user_id'];
    $username= $usersrow['username'];
    $user_password = $usersrow['password'];
    $user_firstname =$usersrow['user_firstname'];
    $user_lastname =$usersrow['user_lastname'];
    $user_email =$usersrow['user_email'];
    $user_image = $usersrow['user_image'];
    $user_role= $usersrow['user_role'];
?>
                            <tr>
                                <td><?php echo  $user_id; ?></td>
                                <td><?php echo  $username; ?></td>
                                <td><?php echo  $user_firstname; ?></td>
                                <td><?php echo  $user_lastname ?></td>
                                <td><?php echo  $user_email ?></td>
                                <td><img src="<?php echo '../images/'.$user_image ?>" width="100"></td>  
                                <td> <?php echo  $user_role   ?></td>

                                <?php
                                // $queryofselectpostresponse ="SELECT * FROM posts WHERE post_id ='$comment_post_id' ";
                                // $queryconn = mysqli_query($connection,$queryofselectpostresponse);
                                // while($row_queryofselectpostresponse=mysqli_fetch_assoc($queryconn))
                                // {$post_id=$row_queryofselectpostresponse['post_id'];
                                // $post_title=$row_queryofselectpostresponse['post_title'];

                                // }
                                ?>
                                <td><a href="users.php?change_to_Admin=<?php echo $user_id; ?>"><p style="color:green">Admin</p></a></td>
                                <td><a href="users.php?change_to_sub=<?php echo $user_id; ?>"><p style="color:orange">Subscriber</p></a></td>                                
                                <td><a onclick="javascript: return confirm('Are you sure you want to delete'); " href="users.php?delete=<?php echo $user_id;?>"><p style="color:red">Delete</p></a></td>           
                                <td><a href="users.php?source=edit_user&p_id=<?php echo $user_id; ?>"><p style="color:brown">Edit</p></a></td>                   
                            </tr>
                  
                    
<?php }?>                       </tbody>
</table>  
<?php
////Admin
if(isset($_GET['change_to_Admin']))
{
$change_to_Admin = $_GET['change_to_Admin'];
$change_to_Admin_userstatus=" UPDATE users SET user_role = 'Admin' WHERE user_id = '$change_to_Admin' ";
$change_to_Admin_userstatusquerystatus = mysqli_query($connection, $change_to_Admin_userstatus); 
catch_errors($change_to_Admin_userstatusquerystatus);
header("Location: users.php");}
/////////////////////// subscriber
if(isset($_GET['change_to_sub']))
{
$change_to_sub = $_GET['change_to_sub'];
$querystatus=" UPDATE users SET user_role = 'Subscriber' WHERE user_id = '$change_to_sub' ";
$querystatuscomment = mysqli_query($connection, $querystatus); 
catch_errors($querystatuscomment);
header("Location: users.php");}

///////////////////////////////////////////Delete user


if(isset($_GET['delete']))
{
$delete_user = $_GET['delete'];
$querydeletethisuser = "DELETE FROM users WHERE user_id = '$delete_user' ";
$deletethisuser = mysqli_query($connection, $querydeletethisuser); 
catch_errors($deletethisuser);

header("Location: users.php");}
?>
