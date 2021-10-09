<?php
include('database_crud.php');

class Login {

    public function login() {
     $username=$_POST['username'];
     $password=$_POST["password"];
      $dbcrud=New database_crud();
     $user_data= $dbcrud->fetch('login',$where='WHERE username = "'.$username.'"');
     $message ='';
    
     if($user_data['count'] > 0)
    {
     $result =$user_data['rows'] ;
       foreach($result as $row)
       {
         if( password_verify($password, $row['password']))
         {
           if($row['status']=='Enable' &&$row['verification_code']!=''){
           

           $_SESSION['user_id'] = $row['user_id'];
           $_SESSION['username'] = $row['username'];
           $user_id=$row['user_id'];
           $login_data=array(
           'user_id'=>$user_id
           );
           $inser_user_login_details=array();
           $inser_user_login_details=$dbcrud->insert('login_details',$login_data);
           
         if($inser_user_login_details['insert_status']==true){
           
           $_SESSION['login_details_id']=$inser_user_login_details['lastInsertId'];
            header("location:../views/home.php");
           }
           }else{
            $message = "<label>you must verify your email  </label>";
           }
           
        
         }
         else
         {
          $message = "<label>Wrong Password</label>";
         }
       }
    }
    else
    {
     $message = "<label>Wrong Username</labe>";
    }
         return $message;
        }

}


?>
