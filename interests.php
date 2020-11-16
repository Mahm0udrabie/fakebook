<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
    <!-- Navigation -->
<?php include "includes/navigation.php";?>
<br><br>
<?php include "includes/functions.php";?>


    <!-- Page Content -->
    <div class="container">

     <div class="row">
                <div class="col-md-8">
             
                    <div class="col-md-6">
                    <?php 
                    insert_favourites(); 
                    $fav_id= "" ;$fav_name=""; $user_favourites = "";   
                    ?>   
                
                <form action="" method="post">
                <?php if(isset($fav_EXIT)) { echo $fav_EXIT; } ?>

                <div class="form-group">
                    <label for="cat-title">Add favourite</label>
                    <input type="text" class="form-control" name="cat_title" list="interstes">
                    <datalist id="interstes" name="cat_title">
                            <?php 
                            $categoriesquery ="SELECT * FROM favourites ORDER BY fav_id";
                            $select_categories=mysqli_query($connection, $categoriesquery);
                            
                            while ($row = mysqli_fetch_assoc($select_categories))
                            {
                            $fav_id = $row["fav_id"];
                            $fav_name = $row["fav_name"];
                            $user_favourites = $row['user_favourites'];
                            echo "<option value='".$fav_name."'> ".$fav_name ."</option>";
                            }
                           $ArrayFav = [$fav_id,$fav_name,$user_favourites];
                            ?>
                    </datalist>
                   
              


                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="submit" value="Add ">
                </div>
                <?php 
                    if($user_favourites != $_SESSION['username'])
                    {
                        if(!in_array($_SESSION['username'],$ArrayFav)){
                          echo $catch = "<p class='text-danger'style='font-size:25px'>Add your favourites</p>";
                        }
                    }
                ?>

</form>
<?php if(isset($_GET['edit']))
{
    $fav_id = $_GET['edit'];
    update_favourites();
// include "includes/update_categories.php";

}?>
                
                </div>
                <div class="col-md-6"> 
                 <!-- find All  categories -->
                <table class="table table-hover">
                    <thead>
                        <th>id</th>
                        <th>name</th>
                       <th>settings</th>
                    </thead>
                    <tbody>
<?php select_favourites(); ?>
<?php delete_favourites(); ?>

                           
                        </tr>
                    </tbody>
                </table>
                </div>
                
            </div>
            <!-- /.row -->     <?php include "includes/sidebar.php"; ?>

  <?php  include "includes/footer.php"; ?>

        