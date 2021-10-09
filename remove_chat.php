
<?php

include('functions.php');
$db=New Database_Connection();
$connect=$db->connect();
if(isset($_POST["chat_message_id"]))
{

   $where="WHERE chat_message_id = '".$_POST["chat_message_id"]."'";
    $updated_field=array(
      'status'=>'2'
    );
   
   $database_crud->update('chat_message',$updated_field,$where);

}

?>