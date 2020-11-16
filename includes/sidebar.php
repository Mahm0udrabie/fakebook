
               
            <div class="col-md-4" >
    
        <!-- Blog Search Well -->
               <div class="well">
                    <style>
                    .ubtnAU
                    {
                        color:white;
                        font-size:15px;
                        border:0px;
                        outline:none;
                    }
                    .ubtnAU:hover 
                    {
                         color:white !important;
                    }
                    </style>
                 
               <a href="#" type="button" class="ubtnAU">Online Users: <span class="usersonline"></span></a>
              
       


          <!-- login form -->
          <?php
           if(!isset($_SESSION['username']))
          { ?>
          <div class="well">
          <?php 
          if (isset($_SESSION['wrongvalue']))
          {
              echo "<h4 style='color:#be4b49'>".$_SESSION['wrongvalue']."</h4>";
          }
          ?>
          <h4>Login</h4>
          
<!--          <p class="hint-text text-center">Sign in with your social media account</p>-->
<!--<div class="form-group social-btn clearfix text-center">-->
<!--<a href="#" class="btn btn-primary pull "><i class="fa fa-facebook"></i> Facebook</a>-->
<!--<a href="#" class="btn btn-info pull "><i class="fa fa-twitter"></i> Twitter</a>-->
<!--</div>-->
<!--    <div class="or-seperator text-center"><b>or</b></div>-->

                    <!-- strat  login form -->
                    <form action="includes/login.php" method="post" >

                    <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                    <input type="text" name="username" class="form-control" placeholder="Enter username">
                    </div><br>
                    <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
        </div>
                    <span class="input-group-btn" >
                       <button class="btn btn-primary" name="login" type="submit">Login</button>
                    </span>
                   </div><br>
                   <div class="form-group">

                <a style="color:white" href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forgot Password</a>


</div>
 <p style="color:Gray;">website helps you connect and share your amazing moments with other people.</p>

          
                   </form>
                    <!-- End  login form -->
                    
                
             </div>
        </div>
         <?php }      
        if(isset($_SESSION['username']))
          { ?> 
         
                
                <!-- Blog Categories Well -->
               
                  <?php 
          
                  
                    $categoriesquery ="SELECT * from favourites WHERE user_favourites = '".$_SESSION['username']."' ORDER BY fav_id";
                    $select_categories_sidbar=mysqli_query($connection,$categoriesquery);
                  
                    ?>
                    
                    <h4><a href="interests.php" style="color:white">Favourites</a></h4>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php 
                                
                                  while ($row = mysqli_fetch_assoc($select_categories_sidbar))
                                  {
                                    $fav_name = $row["fav_name"];
                                    $fav_id = $row["fav_id"];
                                  
                                ?>
                                <li><a href="category.php?category=<?php echo  $fav_id; ?>"><?php echo  $fav_name;}?></a>
                                </li>
                          
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                     
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                <?php } ?>


                <!-- Side Widget Well -->
     <?php include "includes/widget.php" ;?>

            </div>
            </div
