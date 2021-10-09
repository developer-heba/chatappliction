<!--
//login.php
!-->

<?php
include('database_crud.php');

session_start();


include('../classes/login.php');
if(isset($_GET['code'])&&isset($_GET['email']))
{
  $email=$_GET['email'];
 
    $verification_code=$_GET['code'];
    $database_crud=new database_crud();
  $where="WHERE email = '".$email."'";
    $updated_field=array(
      'status'=>'Enable',
      'verification_code'=>$verification_code

    );
   
   $database_crud->update('login',$updated_field,$where);
    $_SESSION['success_message'] = 'Your Email Successfully verify, now you can login into this chat Application';

    header('location:login.php');  
   
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
      <div class="panel-heading">Chat Application Login</div>
    <div class="panel-body">
     <form method="post">
      <p class="text-danger"><?php echo $message; ?></p>
      <div class="form-group">
       <label>Enter Username</label>
       <input type="text" name="username" class="form-control" required />
      </div>
      <div class="form-group">
       <label>Enter Password</label>
       <input type="password" name="password" class="form-control" required />
      </div>
      <div class="form-group">
       <input type="submit" name="login" class="btn btn-info" value="Login" />
      </div>
      <div align="center">
       <a href="register.php">register</a>
      </div>
     </form>
    </div>
   </div>
  </div>
    </body>  
</html>