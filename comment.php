<select name="allbooks" id="allbooks">
  <option value="none" ></option>
  <option value="allbooks" >All Books</option>
  <option value="allbooks" >All Books</option>

</select>
<div id="show">
  <!-- ITEMS TO BE DISPLAYED HERE -->
</div>
<script src="jquery-1.9.1.min.js"></script> <!-- CHANGE THE JQUERY FILE DEPENDING ON THE VERSION YOU HAVE DOWNLOADED -->
<script type="text/javascript">
  $(document).ready(function(){ /* PREPARE THE SCRIPT */
    $("#allbooks").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
      var allbooks = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
      var dataString = "allbooks="+allbooks; /* STORE THAT TO A DATA STRING */

      $.ajax({ /* THEN THE AJAX CALL */
        type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url: "comment.php", /* PAGE WHERE WE WILL PASS THE DATA */
        data: dataString, /* THE DATA WE WILL BE PASSING */
        success: function(result){ /* GET THE TO BE RETURNED DATA */
          $("#show").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
        }
      });

    });
  });
</script>
<?php 

if(!empty($_POST["allbooks"])){
    /* DO YOUR QUERY HERE AND GET THE OUTPUT YOU WANT */
    echo $_POST["allbooks"]; /* PRINT THE OUTPUT YOU WANT, IT WILL BE RETURNED TO THE ORIGINAL PAGE */
  }
?>