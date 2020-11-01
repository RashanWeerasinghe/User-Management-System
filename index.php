<?php require_once('inc/connection.php'); ?>
<?php

$errors=array();
//check for form submission
if(isset($_POST['submit'])){
// check if the y=username and password has beeb enterd
if(!isset($_POST['email'])||strlen(trim($_POST['email']))<1){
     $errors[]='useranme is missing/Invaild';


}
if(!isset($_POST['password'])||strlen(trim($_POST['password']))<1){
     $errors[]='password is missing/Invaild';


}
// check if there are any errors in the form
if(empty($errors)){
 
// save username and password into variables
     $email=mysqli_real_escape_string($connection,$_POST['email']);
      $password=mysqli_real_escape_string($connection,$_POST['password']);
      $hashed_password=sha1($password)

     // prepare database query
      $query = "SELECT *FROM user
              WHERE email='{$email}'
              AND password ='{$hashed_password}' 
              LIMIT 1  ";

       $result_set=mysqli_query($connection,$query);
       if($result_set) {

 //query successfull

          if(mysqli_num_rows($result_set)==1){


               //valid user found
               // check if the user is vaild
               // redirect to users.php
               header('location: users.php');
          }
          else {
               //invild user found
               $errors[]='invaild username/password';
          }

       }else{

$errors[]='database query faild';

       }      
  
}
  
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Log In - User Management System</title>
     <link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div class="login">
   <form action="index.php" method="post">
     <fieldset>
     <legend>
     	<h1> Log In</h1>
          </legend> 
          <?php

          if(isset($errors)&& !empty($errors)){

               echo '<p class="error">Invalid Username / password</p>';
          }

               ?>
          
     	<p>
     		
     		<label for="">username:</label>
     		<input type="text" name="email" id="" placeholder="email address">


     	</p>
     	<p>
     		
     		<label for="">password</label>
     		<input type="password" name="password" id="" placeholder="password">
     	</p>

     	<p>
     		<button type="submit" name="submit">log In</button>


     	</p>


     
      



     </fieldset>


	</div> 
</body>
</html>
<?php mysqli_close($connection); ?>