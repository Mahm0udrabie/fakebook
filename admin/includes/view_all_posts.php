<?php   
    include "delete_modal.php";
    ?>
    

    <?php
if(isset($_POST['checkBoxArray'])) 
foreach ($_POST['checkBoxArray'] as $checkBoxValue) {
$bulk_options = $_POST['bulk_options'];
switch($bulk_options)
{
case 'published':
$queryofpublished="UPDATE posts SET post_status = '$bulk_options' WHERE post_id ='$checkBoxValue' ";
$sendthequery = mysqli_query($connection, $queryofpublished);
break;
case 'draft':
$queryofdraft="UPDATE posts SET post_status = '$bulk_options' WHERE post_id ='$checkBoxValue' ";
$sendthedraf = mysqli_query($connection, $queryofdraft);
break;
case 'delete':
$queryofDelete="DELETE FROM posts WHERE post_id ='$checkBoxValue' ";
$sendthedelete= mysqli_query($connection, $queryofDelete);
break;
case 'clone':
$queryclone = "SELECT * FROM posts WHERE post_id = '$checkBoxValue' ";
$select_post_queryclone = mysqli_query($connection, $queryclone);

while ($rowclone = mysqli_fetch_assoc($select_post_queryclone)) {
$post_title         = $rowclone['post_title'];
$post_category_id   = $rowclone['post_category_id'];
$post_date          = $rowclone['post_date']; 
$post_author        = $rowclone['post_author'];
$post_status        = $rowclone['post_status'];
$post_image         = $rowclone['post_image'] ; 
$post_tags          = $rowclone['post_tags']; 
$post_content       = $rowclone['post_content'];

}
$post_comment_count = 0;
$queryofclone =  "INSERT INTO posts (post_title,post_author,post_category_id,post_comment_count,post_status,post_date,post_image,post_content,post_tags) ";
$queryofclone  .= " VALUES('$post_title','$post_author','$post_category_id','$post_comment_count','$post_status','$post_date','$post_image','$post_content','$post_tags') ";          





    $copy_query = mysqli_query($connection, $queryofclone);   

   if(!$copy_query ) {

    die("QUERY FAILED and its not work" . mysqli_error($connection));
   }  


break;
}
}   

?>

<form action="" method='post'>

<table class="table  table-hover">


<div id="bulkOptionContainer" class="col-xs-4">

<select class="form-control" name="bulk_options" id="">
<option value="">Select Options</option>
<option value="published">Publish</option>
<option value="draft">Draft</option>
<option value="delete">Delete</option>
<option value="clone">Clone</option>
</select>
</div>
<div class="col-xs-4">

<input type="submit" name="submit" class="btn btn-success" value="Apply">
<a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>

</div>
<thead>
<tr>
<th><input id="selectAllBoxes" type="checkbox"></th>

<th>ID</th>
<th>Author/User</th>
<th>Title</th>
<th>Status</th>
<th>Image</th>
<th>Categoryid</th>
<th>Category</th>
<th>views count</th>
<th>Comments</th> 
<th>Tags</th>
<th>Date</th>
</tr>
</thead>   
<tbody>


<?php 
$query_post = "SELECT * FROM posts ORDER BY post_id ";
$select_query = mysqli_query($connection ,$query_post);
catch_errors($select_query);

while($postrow = mysqli_fetch_assoc($select_query))
{
$post_id = $postrow['post_id'];
$post_author= $postrow['post_author'];
$post_category_id= $postrow['post_category_id'];
// $post_user= $postrow['post_user'];
$post_title =$postrow['post_title'];
$post_status =$postrow['post_status'];
$post_content =$postrow['post_content'];
$post_image =$postrow['post_image'];
$post_catrgory_id = $postrow['post_category'];
$post_comment_count = $postrow['post_comment_count'];
$post_tags = $postrow['post_tags']; 
$post_date = $postrow['post_date'];
$post_views   = $postrow['post_views_count'];

?>
<tr>
<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

<td><?php echo  $post_id; ?></td>
<td><?php echo  $post_author; ?></td>
<td><a href='../post.php?p_id=<?php echo $post_id?>'><?php echo  $post_title ?></a> </td>
<td><?php echo  $post_status; ?></td>
<td><img src="<?php echo '../images/'.$post_image ?>" width="100"></td>  
<td><?php  echo $post_category_id ?></td>
<?php 
$sqlselectpost_catrgory_title = "SELECT * FROM categories WHERE cat_id ='$post_category_id' ";
$sql_query = mysqli_query($connection ,$sqlselectpost_catrgory_title);
while( $row_postcategory_tittle = mysqli_fetch_assoc($sql_query))
{
$cat_id_category = $row_postcategory_tittle["cat_id"];
$cat_title_category = $row_postcategory_tittle["cat_title"];
}
?>
<td><?php echo $cat_title_category; ?></td>

<td><a title="Reset Views" href='posts.php?reset=<?php echo $post_id; ?>'><?php echo $post_views; ?></a></td>

<?php
// $QUERYOFcommentcount = "SELECT * FROM comments WHERE comment_post_id = '$post_id'";
// $SENDqueryofcount =mysqli_query($connection, $QUERYOFcommentcount);
// echo $post_comment_count =mysqli_num_rows($SENDqueryofcount);
  ?>
  <?php 
   $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
   $send_comment_query = mysqli_query($connection, $query);

   $row = mysqli_fetch_array($send_comment_query);
   $comment_id = $row['comment_id'];
   $count_comments = mysqli_num_rows($send_comment_query);


   echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";
  ?>
<td><?php echo  $post_tags; ?></td>
<td><?php echo  $post_date;  ?></td>
<td>
<a href="posts.php?source=edit_post&p_id=<?php echo $postrow['post_id'];?>" style="color:green">Edit</a><br>
<a rel="<?php echo $post_id;?>"   href="javascript:void(0)" class="delete_link">Delete</a> 

    </td>  </tr>
                                   
            
               
     

<?php }?>                       </tbody>
</table>  
</form>

    


<?php
if($_SESSION['user_role'] == 'Admin'  || !empty($_SESSION['user_role']))
{
    if(isset($_SESSION['username']) || !empty($_SESSION['username']))
    {
        if (isset($_GET['Delete']))
        {

$delete_post = $_GET['Delete'];
$query="DELETE FROM posts WHERE post_id = {$delete_post} ";
$querydeletepost = mysqli_query($connection, $query);
catch_errors($querydeletepost);
$querydeletecomments=" DELETE FROM comments WHERE comment_post_id = {$delete_post} ";
$queryofdeletecommnts = mysqli_query($connection, $querydeletecomments);  
catch_errors($queryofdeletecommnts);
header("Location: posts.php");

}
}

} 
else
{
header("Location:../index.php"); 

}

    if($_SESSION['user_role'] == 'Admin'  || !empty($_SESSION['user_role']))
    {
    if(isset($_SESSION['username']) || !empty($_SESSION['username']))
    {

    if (isset($_GET['reset']))
    {

    $the_post_id =mysqli_real_escape_string($connection,  $_GET['reset']);
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $the_post_id  ";
    $reset_query = mysqli_query($connection, $query);
    header("Location: posts.php");


    }

    } 
    else
    {
    header("Location:../index.php"); 

    }
    }


?>

<script>
    


    $(document).ready(function(){


        $(".delete_link").on('click', function(){


             var id = $(this).attr("rel");
 
            var delete_url = "posts.php?Delete="+ id +" ";

            $(".modal_delete_link").attr("href",delete_url);

             $("#myModal").modal('show');




        });



    });




  <?php if(isset($_SESSION['message'])){

         unset($_SESSION['message']);

     }

         ?>



</script>
            