
<table class="table table-bordered table-hover" style="text-align:center;" >
<style>
.table td {
   text-align: center;   
}
</style>
                        <thead >
                            <tr>
                                <th>ID</th>
                                <th>name</th>
                                <th>Email</th>
                                <th>subject</th>
                                <th>body</th>

                            </tr>
                        </thead>   
                        <tbody>

                        
<?php 
$query_feedback = "SELECT * FROM feedback";
$select_feedback = mysqli_query($connection ,$query_feedback);
catch_errors($select_feedback);

while($feedbackrow = mysqli_fetch_assoc($select_feedback))
{
    $contact_id = $feedbackrow['contact_id'];
    $name= $feedbackrow['contact_name'];
    $email = $feedbackrow['contact_email'];
    $subject =$feedbackrow['contact_subject'];
    $body =$feedbackrow['contact_body'];

?>
                            <tr>
                                <td><?php echo  $contact_id; ?></td>
                                <td><?php echo  $name; ?></td>
                                <td><?php echo  $email; ?></td>
                                <td><?php echo  $subject ?></td>
                                <td><?php echo  $body ?></td>

                                 
                                <td><a onclick="javascript: return confirm('Are you sure you want to delete'); " href="feedback.php?delete=<?php echo $contact_id;?>"><p style="color:red">Delete</p></a></td>           
                            </tr>
                  
                    
<?php }?>                       </tbody>
</table>  
<?php

///////////////////////////////////////////Delete contact


if(isset($_GET['delete']))
{
$delete_contact = $_GET['delete'];
$querydeletethiscontact = "DELETE FROM feedback WHERE contact_id = '$delete_contact' ";
$deletethiscontact = mysqli_query($connection, $querydeletethiscontact); 
catch_errors($deletethiscontact);

header("Location: feedback.php");}
?>
