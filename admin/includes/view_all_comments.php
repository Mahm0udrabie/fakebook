
<table class="table table-bordered table-hover" style="text-align:center;" >
<style>
.table td {
   text-align: center;   
}
</style>
                        <thead >
                            <tr>
                                <th>ID</th>
                                <th>commPost_id</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Date</th>
                    
                            </tr>
                        </thead>   
                        <tbody>

                        
<?php 
global $connection;
$query_comment = "SELECT * FROM comments";
$select_query = mysqli_query($connection ,$query_comment);
catch_errors($select_query);

while($commentrow = mysqli_fetch_assoc($select_query))
{
    $comment_id = $commentrow['comment_id'];
    $comment_post_id= $commentrow['comment_post_id'];
    $comment_author= $commentrow['comment_author'];
    $comment_content =$commentrow['comment_content'];
    $comment_email =$commentrow['comment_email'];
    $comment_status =$commentrow['comment_status'];
    $comment_date = $commentrow['comment_date'];
?>
                            <tr>
                                <td><?php echo  $comment_id; ?></td>
                                <td><?php echo  $comment_post_id; ?></td>
                                <td><?php echo  $comment_author; ?></td>
                                <td><?php echo  $comment_content; ?></td>
                                <td><?php echo  $comment_email ?></td>
                                <td><?php echo  $comment_status; ?></td>
                                <td><?php echo  $comment_date ?></td>

                                <?php
                                $queryofselectpostresponse ="SELECT * FROM posts WHERE post_id ='$comment_post_id' ";
                                $queryconn = mysqli_query($connection,$queryofselectpostresponse);
                                while($row_queryofselectpostresponse=mysqli_fetch_assoc($queryconn))
                                {$post_id=$row_queryofselectpostresponse['post_id'];
                                $post_title=$row_queryofselectpostresponse['post_title'];

                                }
                                ?>

                                <td><a href="comments.php?approve=<?php echo $comment_id; ?>"><p style="color:green">Approve</p></a></td>
                                <td><a href="comments.php?unapprove=<?php echo $comment_id; ?>"><p style="color:orange">Unapprove</p></a></td>  
                                <td><a onclick="javascript: return confirm('Are you sure you want to delete'); " href="comments.php?delete=<?php echo $comment_id;?>"><p style="color:red">Delete</p></a></td>                           
                            </tr>
                  
                    
<?php }?>                       </tbody>
</table>  
<?php
////approve comment
if(isset($_GET['approve']))
{
$approve_comment_id = $_GET['approve'];
$approvequerystatus=" UPDATE comments SET comment_status = 'approved' WHERE comment_id = '$approve_comment_id' ";
$approveequerystatuscomment = mysqli_query($connection, $approvequerystatus); 
catch_errors($approveequerystatuscomment);
header("Location: comments.php");}
/////////////////////// un approve comment
if(isset($_GET['unapprove']))
{
$unapprovecomment_id = $_GET['unapprove'];
$querystatus=" UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = '$unapprovecomment_id' ";
$querystatuscomment = mysqli_query($connection, $querystatus); 
catch_errors($querystatuscomment);
header("Location: comments.php");}
 
///////////////////////////////////////////Delete comment
if(isset($_GET['delete']))
{
$delete_comment = $_GET['delete'];
$query="DELETE FROM comments WHERE comment_id = {$delete_comment} ";
$querydeletecomment = mysqli_query($connection, $query); 
catch_errors($querydeletecomment);
header("Location: comments.php");
}

?>
