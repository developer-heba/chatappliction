<?php
include('database_crud.php');


class Register {

    public function register() {

      $username = trim($_POST["username"]);
      $password = trim($_POST["password"]);
      $email = trim($_POST["email"]);
      $message='';
      global $database_crud;

      $where="WHERE ( WHERE username= '".$username ."' AND email='".$email."'"
      ;
    
     $result =$database_crud->fetch('login',$where);
       
        if($result['count'] > 0)
        {
        $message .= '<p><label>Username already taken</label></p>';
        }
        else
        {
        if(empty($username))
        {
          $message .= '<p><label>Username is required</label></p>';
        }
        if(empty($password))
        {
          $message .= '<p><label>Password is required</label></p>';
        }
        else
        {
          if($password != $_POST['confirm_password'])
          {
          $message .= '<p><label>Password not match</label></p>';
          }
        }
        if($message == '')
        {
          $data = array(
          'username'  => $username,
          'password'  => password_hash($password, PASSWORD_DEFAULT),
          'email'=>  $email
          );

              $database_crud=New database_crud();
              $insert_chat=$database_crud->insert('login',$data);/*should be associtive array with field name key
              */ 
      
         
          if($insert_chat['insert_status']==true)
          {
           
    
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure ='ssl';
                $mail->Port = 465;
                $mail->Username   = 'heba2491990@gmail.com';                     // SMTP username
                $mail->Password   = 'omarammar_12345678';
                $mail->setFrom('heba2491990@gmail.com', 'heba');
    
                $mail->addAddress($email,$userName);
    
                $mail->isHTML(true);
    
                $mail->Subject = 'Registration Verification for Chat Application Demo';
    
                $mail->Body = '
                <p>Thank you for registering for Chat Application Demo.</p>
                    <p>This is a verification email, please click the link to verify your email address.</p>
                    <p><a href="http://localhost/chat_application-oop/views/verify.php?code='.md5(uniqid()).'">Click to Verify</a></p>
                    <p>Thank you...</p>
                ';
    
                $mail->send();
                if( $mail->send()){
                    $success_message = 'Verification Email sent to ' . $email . ', so before login first verify your email'; 
                    header('location:login.php');
                }else{
                    $$message = 'Something went wrong try again';
                }
            
       
          }
        }
        }
        return $message;
      

}


}
