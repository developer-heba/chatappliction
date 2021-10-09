<?php
include('functions.php');

session_start();
$where="WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";

$updated_field=array(
    'is_type'=>$_POST["is_type"]
  );
 
 $database_crud->update('login_details',$updated_field,$where);

?>