<?php
include('functions.php');
session_start();
$fetch_user=new database_crud();
$result = $fetch_user->fetch('login',"WHERE user_id != '".$_SESSION['user_id']."' ");

$output = '
<table class="table table-bordered table-striped">
 <tr>
  <td>Username</td>
  <td>Status</td>
  <td>Action</td>
 </tr>
';

foreach($result['rows'] as $row)
{
 $status = '';
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');//time since 10 second in unix timestamp (in seconds)

 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);//format the time to Y-m-d H:i:s
 
 
 $user_last_activity = fetch_user_last_activity($row['user_id']);
 
 if($user_last_activity > $current_timestamp)
 {
  $status = '<span class="label label-success">Online</span>';
 }
 else
 {
  $status = '<span class="label label-danger">Offline</span>';
 }
 $output .= '
 <tr>
  <td>'.$row['username'].' '.count_unseen_message($row['user_id'],$_SESSION['user_id']).' '.fetch_is_type_status($row['user_id']).'</td>
  <td>'.$status.'</td>
  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'">Start Chat</button></td>
 </tr>
 ';
}

$output .= '</table>';

echo $output;

?>