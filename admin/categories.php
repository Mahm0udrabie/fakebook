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
                <div class="col-md-12">
                    <h1 class="page-header">
                    
                    Welcome 
                            <small><?php if(isset($_SESSION['username'])) {  echo $_SESSION['username']; } else {header("Location : ../index.php"); }  ?></small>
                        </h1>
                 
                    <div class="col-md-6">
                    <?php 
                    insert_categories(); 
                    ?>   
                
                <form action="" method="post">
                <div class="form-group">
                    <label for="cat-title">Add Category</label>
                    <input type="text" class="form-control" name="cat_title">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                </div>


</form>
<?php if(isset($_GET['edit']))
{
    $cat_id = $_GET['edit'];
    update_categories();
// include "includes/update_categories.php";

}?>
                
                </div>
                <div class="col-md-6"> 
                 <!-- find All  categories -->
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>ID</th>
                        <th>Title</th>
                       
                    </thead>
                    <tbody>
<?php select_categories(); ?>
<?php delete_categories(); ?>

                           
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>
