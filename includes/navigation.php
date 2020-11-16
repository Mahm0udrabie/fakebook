<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    
        <div class="container">
         
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
            
                 <a class="navbar-brand" href="./index.php">
                 <i style="font-size:25px;" class="fa fa-facebook text-white"></i>akebook               </a>
               
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <?php  if(isset($_SESSION['username'])) {?>
               <!-- strat  search form -->
               <li  id="result-side-menu"> 
               <div class="searchinnav">
                   <style>
                       #result-side-menu:hover
                       {
                        background-color:transparent !important;
                       }
                       #result-side-menu
                       {
                        width:350px;
                       }
          
                   .searchinnav
                   {
                       margin:auto;
                       margin-top:10px;
                   }
                   .searchinnav
                   {
                       width:100%;
                   }
                </style>
               
               <form action="search.php" method="post" >
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="search" style="outline:none;border:0px solid white;height:33.5px;">
                        <span class="input-group-btn" >
                            <button name="submit" class="btn btn-default" type="submit" style="background-color:#f5f6f7;:none;border:0px solid white;height:33.5px;width: 45px;">
                             <span class="glyphicon glyphicon-search" style="color:black"></span>
                        </button>
                        </span>
                    </form>
                    <!-- End  search form -->
                    </div>
                
           </div>
                </li>
                <?php } ?>
                    <!-- /.input-group -->

                    
                    <?php
                    // $query ="SELECT * from categories  ORDER BY cat_id ";
                    // $select_all_categories=mysqli_query($connection,$query);
                    // while ($row=mysqli_fetch_assoc($select_all_categories))
                    // {
                    //   $cat_id = $row["cat_id"];
                    //   $cat_title = $row["cat_title"];
                      $category_class='';
                      $registration_class='';
                      $contact_class='';
                      $interests_class='';
                      $registration = 'registration.php';
                      $contact = 'contact.php';
                      $interests = 'interests.php';
                      $pageName= basename($_SERVER['PHP_SELF']);
                      if($pageName == $registration) {
                        $registration_class='active';
                        ?>
                        <style>
                        body {
                            background-color:white;
                        }
                        </style>

                        <?php
                        
                      }
                      else if($pageName == $contact) {
                        $contact_class='active';
                      }
                      else if($pageName == $interests) {
                        $interests_class='active';
                        ?>
                        <style>
                        body {
                            background-color:white;
                        }
                        </style>

                        <?php
                      }
                    //   "<li class='{$category_class}'><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                  //  } ?> <?php if(isset($_SESSION['username'])) {?>
                       <li class="<?php  echo $interests_class; ?>">
                        <a href="interests.php">Favourites</a>
                    </li>
                  <?php  }?>
                    <li class="<?php  echo $contact_class; ?>">
                        <a href="contact.php">Contact</a>
                    </li>
                    <li>
                        <a href="#" onclick="myFunction()">About</b></a>
                    </li>
                  
                            <style>
                            #myDIV {
                                width: 100%;
                                height:100px;
                                padding: 50px 0;
                                text-align: center;
                                background-color: ;
                                margin-top: 20px;
                                color:white;
                            }
                            </style>

                        <script>
                        function myFunction() {
                            var x = document.getElementById("myDIV");
                            if (x.style.display === "block") {
                                x.style.display = "none";
                            } else {
                                x.style.display = "block";
                            }
                        }
                        </script>

                    <?php
                    if (isset($_SESSION['user_role']))
                    {
                        if($_SESSION['user_role'] == 'Admin')
                        {
                    ?>
                   <li>
                        <a href="admin">Admin</a>
                    </li>
                   
                    <?php } }
                   if (!isset($_SESSION['username'])) { ?>
                    
                    <li class="<?php  echo $registration_class; ?>">
                        <a href="registration.php">Registration</a>
                    </li>
                  
                    <?php } ?>
              
              
                </ul>
                <?php if(isset($_SESSION['firstname'])) { ?> 
               
                <ul class="nav navbar-nav navbar-right top-nav">
              
                        <li>
                            <a href="#">
                            
                            <img src="http://placehold.it/64x64" alt="" style="border-radius: 50%; height:25px">

                            
                            <?php   echo   $_SESSION['firstname'];  ?>
                            </a>
                            
                        </li>
                     <li class="dropdown">
                    <a href="#" class="dropdown-toggle" ><i class="fa fa-envelope"></i> </b></a>         
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                       
                        <!-- <li class="divider"></li> -->
                        <!-- <li>
                            <a href="#">View All</a>
                        </li> -->
                    </ul>
                </li>
                <li>
                        <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="caret"></b> </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                    
                        <li>
                            <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
                <?php } ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
       
        <!-- /.container -->
        <div id="myDIV" hidden>
        we are doing nothing until now
                </div>
    </nav><br>
   <?php 
   if(!isset($_SESSION['username'])) {
       ?>
<style>
.well
{
    
    color: white;
    background-color: rgb(3, 21, 59);
    outline:none;
    border: 0px solid;
    
}

</style>
       <?php 
   }
   
   ?>