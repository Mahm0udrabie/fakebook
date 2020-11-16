<?php function uploadfile() { ?>
  <div class="input-file-containercontainer">  
    <input class="input-file" id="my-file" type="file" name="image">

    <label tabindex="0" for="my-file" class="input-file-trigger"><span class="glyphicon glyphicon-picture "></span> Picture  
</label>

  </div>
  <p class="file-return"></p>
<style>

.input-file-containercontainer {
  position: relative;
  width:130px;
} 
.js .input-file-trigger {
  display: block;
  padding: 10px 25px;
  background: blue ;
  color: #fff;
  font-size: 1em;
  transition: all .4s;
  cursor: pointer;
}
.js .input-file {
margin-bottom:-30px;
  opacity: 0;
  cursor: pointer;
}
.js .input-file:hover + .input-file-trigger,
.js .input-file:focus + .input-file-trigger,
.js .input-file-trigger:hover,
.js .input-file-trigger:focus {
  background: #34495E;
  color: #39D2B4;
}

/* .file-return {
  margin: 0;
} */
.file-return:not(:empty) {
  margin: 1em 0;
}
.js .file-return {
  font-style: italic;
  font-size: .9em;
  font-weight: bold;
}
.js .file-return:not(:empty):before {
  content: "Selected file: ";
  font-style: normal;
  font-weight: normal;
}

</style>

<script>
document.querySelector("html").classList.add('js');

var fileInput  = document.querySelector( ".input-file" ),  
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");
      
button.addEventListener( "keydown", function( event ) {  
    if ( event.keyCode == 13 || event.keyCode == 32 ) {  
        fileInput.focus();  
    }  
});
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});  
fileInput.addEventListener( "change", function( event ) {  
    the_return.innerHTML = this.value;  
});  
</script>
<?php } 
//uploadfile();

?>
