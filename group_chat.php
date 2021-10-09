<?php

//group_chat.php

include('functions.php');
session_start();

if($_POST["action"] == "insert_data")
{
 $data = array(
    'from_user_id'  => $_SESSION["user_id"],
    'chat_message'  => $_POST['chat_message'],
    'status'   => '1'
   );
   
   if($_POST['chat_message']!==""){
    $database_crud=New database_crud();
    $insert_chat=$database_crud->insert('chat_message',$data/*should be associtive array with field name key
    */);

   }
   echo fetch_group_chat_history();
}

if($_POST["action"] == "fetch_data")
{
 echo fetch_group_chat_history();
}

?>
