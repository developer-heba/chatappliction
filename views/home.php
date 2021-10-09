<!--
//index.php
!-->

<?php

session_start();
if(!isset($_SESSION["user_id"])){
    header("location:login.php");
  
  }
?>
<html>  
    <head>  
        <title>Chat Application using PHP Ajax Jquery</title>  
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
        <link rel="stylesheet" href="../css/style.css">
    </head>  
    <body>  
        <div class="container">
   <br />
   
   <h3 align="center">Chat Application using PHP Ajax Jquery</a></h3><br />
   <br />
   <div class="row">
    <div class="col-md-8 col-sm-6">
     <h4>Online User</h4>
    </div>
    <div class="col-md-2 col-sm-3">
     <input type="hidden" id="is_active_group_chat_window" value="no" />
     <button type="button" name="group_chat" id="group_chat" class="btn btn-warning btn-xs">Group Chat</button>
    </div>
    <div class="col-md-2 col-sm-3">
     <p align="right">Hi - <?php echo $_SESSION['username']; ?> - <a href="logout.php">Logout</a></p>
    </div>
   </div>
   <div class="table-responsive">
    
    <div id="user_details"></div>
    <div id="user_model_details"></div>
   </div>
  </div>

  
<div id="group_chat_dialog" title="Group Chat Window">
 <div id="group_chat_history" style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;">

 </div>
 <div class="form-group">
  <!--<textarea name="group_chat_message" id="group_chat_message" class="form-control"></textarea>!-->
  <div class="chat_message_area">
   <div id="group_chat_message" contenteditable class="form-control">

   </div>
   <div class="image_upload">
    <form id="uploadImage" method="post" action="upload.php">
     <label for="uploadFile"><img src="upload.png" /></label>
     <input type="file" name="uploadFile" id="uploadFile" accept=".jpg, .png" />
    </form>
   </div>
  </div>
 </div>
 <div class="form-group" align="right">
  <button type="button" name="send_group_chat" id="send_group_chat" class="btn btn-info">Send</button>
 </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

<script src='../js/script.js'> </script>
    </body>  
</html>



