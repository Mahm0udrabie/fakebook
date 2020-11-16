  <!-- Trigger the modal with a button -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <style>
        .activeicon {
          width:10px;
          background-color:green;
          height:10px;
          border-radius:50%;
        }
        </style>
        <?php 
            $time = time();

            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;
            $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            while ($row= mysqli_fetch_array($users_online_query))

            {

          echo "<p >"."<div class='activeicon'></div>".$row['activeusers']."</p>";
            
            }
            
            ?>
        </div>
        <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        
      </div>
      
    </div>
  </div>
  

