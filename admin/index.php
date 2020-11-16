
<?php include "includes/admin_header.php" ?>


    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; 
        require  '../vendor/autoload.php'; ?>


        <div id="page-wrapper">

            <div class="container-fluid">
      
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                        
                            Welcome 
                            <small><?php if(isset($_SESSION['username'])) {  echo $_SESSION['username']; } else {header("Location : ../index.php"); }  ?></small>
                        </h1>
                        <div class="row">
                        <style>
                        @media only screen and (min-width: 1000px) 
                        
                        {
                            #divsize
                            {
                            width:220px;
                            }
                        }
                        </style>
    <div  id="divsize" class="col-md-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                   <?php 
                   $query_posts_num="SELECT * FROM posts";
                   $sending_query=mysqli_query($connection ,$query_posts_num);
                   $postCOUNT = mysqli_num_rows($sending_query);
                   ?>
                   <div class="huge"><?php echo $postCOUNT;?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
                    <div id="divsize" class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                 <?php 
                   $query_comments_num="SELECT * FROM comments";
                   $sendingQuery=mysqli_query($connection ,$query_comments_num);
                   $commentCOUNT = mysqli_num_rows($sendingQuery);
                   ?>
                   <div class="huge"><?php echo $commentCOUNT;?></div>
           
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div id="divsize" class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php 
                   $query_users_num="SELECT * FROM users";
                   $sendquery=mysqli_query($connection ,$query_users_num);
                   $userCOUNT = mysqli_num_rows($sendquery);
                   ?>
                   <div class="huge"><?php echo $userCOUNT;?></div>
                                    
                                       
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div id="divsize" class="col-lg-3 col-md-6">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                   <?php 
                   $query_feedback_num="SELECT * FROM feedback";
                   $sending_query=mysqli_query($connection ,$query_feedback_num);
                   $feedCOUNT = mysqli_num_rows($sending_query);
                   ?>
                   <div class="huge"><?php echo $feedCOUNT;?></div>
                        <div>Feedback</div>
                    </div>
                </div>
            </div>
            <a href="feedback.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
                    <div id="divsize" class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php 
                   $query_categories_num="SELECT * FROM categories";
                   $sendingQuery=mysqli_query($connection ,$query_categories_num);
                   $categoryCOUNT = mysqli_num_rows($sendingQuery);
                   ?>
                   <div class="huge"><?php echo $categoryCOUNT;?></div>
                                   <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.row -->
                <?php 
                   $query_draft_posts_num="SELECT * FROM posts WHERE post_status='draft'";
                   $sendingQueryofdraftposts=mysqli_query($connection ,$query_draft_posts_num);
                   $draftCOUNT = mysqli_num_rows($sendingQueryofdraftposts);
                   ?>
                    <?php 
                   $unapprovedComments="SELECT * FROM comments WHERE comment_status ='unapproved'";
                   $sendingQueryunapprovedComments=mysqli_query($connection ,$unapprovedComments);
                   $unapprovedCOUNT = mysqli_num_rows($sendingQueryunapprovedComments);
                   ?>
                     <?php 
                   $Subscriber="SELECT * FROM users WHERE user_role ='Subscriber' ";
                   $sendingQuery_Subscriber = mysqli_query($connection ,$Subscriber);
                   $SubscriberCOUNT = mysqli_num_rows($sendingQuery_Subscriber);
                   ?>

                <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Date', 'Count'],
            <?php
            $elementname=['posts','Draft posts','comments','unapproved comments','users','Subscribers','categories'];
            $elementcount=[$postCOUNT, $draftCOUNT,$commentCOUNT, $unapprovedCOUNT,$userCOUNT, $SubscriberCOUNT, $categoryCOUNT];
            for($i=0;$i < 7 ; $i++ )
            {
                echo "['{$elementname[$i]}'".","."{$elementcount[$i]}],";
            }
            ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>
                    </div>
                </div>
                <!-- /.row -->
            

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://js.pusher.com/4.1/pusher.min.js"></script>



        <script>

            $(document).ready(function(){

                Pusher.logToConsole = true;
                var pusher = new Pusher('e8b74b284b8bffaa6f10', {
      cluster: 'eu',
      forceTLS: true
    });


              var notificationChannel =  pusher.subscribe('notifications');


                notificationChannel.bind('new_user', function(notification){

                    var message = notification.message;

                    toastr.success(`${message} just registered`);

                });



            });



        </script>



