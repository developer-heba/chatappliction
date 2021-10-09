<?php
include('classes/database_crud.php');

$database_crud=new database_crud();
function fetch_user_last_activity($user_id)
{  
  global $database_crud;
 date_default_timezone_set('Africa/Cairo');
  $where=  " WHERE user_id = '$user_id' 
  ORDER BY last_activity DESC 
  LIMIT 1";
  
    $result = $database_crud->fetch('login_details',$where);
 foreach($result['rows'] as $row)
 {
  return $row['last_activity'];
 }
}


function fetch_user_chat_history($from_user_id, $to_user_id)
{
  global $database_crud;

  $where="WHERE (from_user_id = '".$from_user_id."' 
  AND to_user_id = '".$to_user_id."') 
  OR (from_user_id = '".$to_user_id."' 
  AND to_user_id = '".$from_user_id."') 
  ORDER BY timestamp DESC";

 $result =$database_crud->fetch('chat_message',$where);
 $output = '<ul class="list-unstyled">';
 foreach($result['rows'] as $row)
 {
  $user_name = '';
  $dynamic_background = '';
  $chat_message = '';
  if($row["from_user_id"] == $from_user_id)
  {
   if($row["status"] == '2')
   {
    $chat_message = '<em>This message has been removed</em>';
    $user_name = '<b class="text-success">You</b>';
   }
   else
   {
    $chat_message = $row['chat_message'];
    $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>';
   }
   

   $dynamic_background = 'background-color:#ffe6e6;';
  }
  else
  {
   if($row["status"] == '2')
   {
    $chat_message = '<em>This message has been removed</em>';
   }
   else
   {
    $chat_message = $row["chat_message"];
   }
   $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id']).'</b>';
   $dynamic_background = 'background-color:#ffffe6;';
  }
  $output .= '
  <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
   <p>'.$user_name.' - '.$chat_message.'
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';

 $where="WHERE from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."' 
 AND status = '1'
 ";
 $updated_field=array(
   'status'=>'0'
 );

$database_crud->update('chat_message',$updated_field,$where);


 return $output;
}



function get_user_name($user_id)
{
  global $database_crud;
  $where="WHERE user_id = '".$user_id."'";
  $field='username';
  $table='login';
  $data=$database_crud->fetch_field($table,$field,$where);
 foreach($data['rows'] as $row)
 {
  return $row['username'];
 }
}



function count_unseen_message($from_user_id, $to_user_id)
{
  global $database_crud;
    $where=  "WHERE from_user_id = '$from_user_id' 
    AND to_user_id = '$to_user_id' 
    AND status = '1'";
    ;
      $result = $database_crud->fetch('chat_message',$where);//return array of rows and number of rows

 $output = '';
 if($result['count'] > 0)
 {
  $output = '<span class="label label-success">'.$result['count'].'</span>';
 }
 return $output;
}


function fetch_is_type_status($user_id)
{
  global $database_crud;
        $where= " WHERE user_id = '".$user_id."' 
        ORDER BY last_activity DESC 
        LIMIT 1";
     
      $result =$database_crud->fetch_field('login_details','is_type',$where);//return array of rows and number of rows
 $output = '';
 foreach($result['rows'] as $row)
 {
  if($row["is_type"] == 'yes')
  {
   $output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
  }
 }
 return $output;
}




function fetch_group_chat_history()
{

  global $database_crud;
  $where=" WHERE to_user_id = '0'  
  ORDER BY timestamp DESC
  ";
  $result = $database_crud->fetch('chat_message',$where);
 $output = '<ul class="list-unstyled">';
 foreach($result['rows'] as $row)
 {
  $user_name = '';
  $chat_message = '';
  $dynamic_background = '';

  if($row['from_user_id'] == $_SESSION['user_id'])
  {
   if($row["status"] == '2')
   {
    $chat_message = '<em>This message has been removed</em>';
    $user_name = '<b class="text-success">You</b>';
   }
   else
   {
    $chat_message = $row['chat_message'];
    $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>';
   }
   $dynamic_background = 'background-color:#ffe6e6;';
  }
  else
  {
   if($row["status"] == '2')
   {
    $chat_message = '<em>This message has been removed</em>';
   }
   else
   {
    $chat_message = $row['chat_message'];
   }
   $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id']).'</b>';
   $dynamic_background = 'background-color:#ffffe6;';
  }
  $output .= '
  <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
   <p>'.$user_name.' - '.$chat_message.' 
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
   
  </li>
  ';
 }
 $output .= '</ul>';
 return $output;
}

?>
