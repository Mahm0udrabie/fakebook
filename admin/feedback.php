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
                <div class="col-lg-12">
                    <h1 class="page-header">

                    Welcome 
                            <small><?php if(isset($_SESSION['username'])) {  echo $_SESSION['username']; } else {header("Location : ../index.php"); }  ?></small>
                        </h1>
                    <?php 
                    if(isset($_GET['source']))
                    {
                        $source =$_GET['source'];
                    }
                    else 
                    {
                        echo  $source = '';
                    }
                    switch($source)
                    {
                        case 'add_user':
                        include "includes/add_user.php";   
                        break;
                        case 'edit_user': 
                        include "includes/edit_user.php";   
                        break;
                        default :
                        include "includes/viewfeedback.php";   
                    }
                    // include "view_all_posts.php";
                    ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>
