
<!--
//register.php
!-->

<?php
include('../classes/database_crud.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

session_start();

$message = '';

if(isset($_SESSION['user_id']))
{
 header('location:home.php');
}

if(isset($_POST["register"]))
{
  $database_crud=new database_crud();
 $username = trim($_POST["username"]);
 $password = trim($_POST["password"]);
 $email= trim($_POST["email"]);
 $where = "
 WHERE username ='".$username."'";
 $result_user = $database_crud->fetch('login',$where);

  if( $result_user['count'] > 0)
  {
   $message .= '<p><label>Username already taken</label></p>';
  }
  else
  {
    $where = "
    WHERE  email='".$email.
    "'";
    $result_email = $database_crud->fetch('login',$where);
    if( $result_email['count'] > 0)
  {
    $message .= '<p><label>email is existed</label></p>';
  }
    
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
     'email'=>$email
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

      $mail->addAddress($email,$username);

      $mail->isHTML(true);

      $mail->Subject = 'Registration Verification for Chat Application Demo';

      $mail->Body = '
      <p>Thank you for registering for Chat Application Demo.</p>
          <p>This is a verification email, please click the link to verify your email address.</p>
          <p><a href="http://localhost/chat_application-oop/views/verify.php?code='.md5(uniqid()).'&&email='.$email .'">Click to Verify</a></p>
          <p>Thank you...</p>
      ';

      $mail->send();
      if( $mail->send()){
        $message= 'Verification Email sent to ' . $email . ', so before login first verify your email'; 
      }else{
          $message = 'Something went wrong try again';
      }
  
    }
   }
  }
 
}

?>

<html>  
    <head>  
        <title>Chat Application using PHP Ajax Jquery</title>  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>  
    <body>  
        <div class="container">
   <br />
   
   <h3 align="center">Chat Application using PHP Ajax Jquery</a></h3><br />
   <br />
   <div class="panel panel-default">
      <div class="panel-heading">Chat Application Register</div>
    <div class="panel-body">
     <form method="post">
      <span class="text-danger"><?php echo $message; ?></span>
      <div class="form-group">
       <label>Enter Username</label>
       <input type="text" name="username" class="form-control" />
      </div>
      <div class="form-group">
       <label>Enter email</label>
       <input type="email" name="email" class="form-control" />
      </div>
      <div class="form-group">
       <label>Enter Password</label>
       <input type="password" name="password" class="form-control" />
      </div>
      <div class="form-group">
       <label>Re-enter Password</label>
       <input type="password" name="confirm_password" class="form-control" />
      </div>
      <div class="form-group">
       <input type="submit" name="register" class="btn btn-info" value="Register" />
      </div>
      <div align="center">
       <a href="login.php">Login</a>
      </div>
     </form>
    </div>
   </div>
  </div>
    </body>  
</html>
