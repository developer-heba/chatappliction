
<?php

//insert_chat.php

include('functions.php');
session_start();

$data = array(
 'to_user_id'  => $_POST['to_user_id'],
 'from_user_id'  => $_SESSION['user_id'],
 'chat_message'  => $_POST['chat_message'],
 'status'   => '1'
);

if($_POST['chat_message']!==''){
    $database_crud=New database_crud();
    $insert_chat=$database_crud->insert('chat_message',$data);/*should be associtive array with field name key
    */ 
}
echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id']);
?>
