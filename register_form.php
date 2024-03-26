<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $business = mysqli_real_escape_string($conn, $_POST['business']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $contact = mysqli_real_escape_string($conn, $_POST['contact']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $address = mysqli_real_escape_string($conn,$_POST['address']);
   $city = mysqli_real_escape_string($conn,$_POST['city']);
   $zipcode = mysqli_real_escape_string($conn,$_POST['zipcode']);
   $food_type = $_POST['food_type'];
   $hours = mysqli_real_escape_string($conn, $_POST['hours']);

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, business, email, contact, password, address, city, zipcode, food_type, hours) VALUES('$name', '$business', '$email', '$contact', '$pass','$address','$city','$zipcode','$food_type', '$hours')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="login.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" placeholder="enter your name">
      <input type="text" name="business" placeholder="enter the name of your business">
      <input type="email" name="email" placeholder="enter your email">
      <input type="tel" name="contact" placeholder="enter your phone number">
      <input type="password" name="password" placeholder="enter your password">
      <input type="password" name="cpassword" placeholder="confirm your password">
      <input type="text" name="address" placeholder="enter your address">
      <input type="text" name="city" placeholder="enter your city">
      <input type="text" name="zipcode" placeholder="enter your zipcode">
      <select name="food_type" placeholder="type of food">
         <option value="produce">produce</option>
         <option value="meat">meat</option>
         <option value="dairy">dairy</option>
         <option value="bakery">baked goods</option>
         <option value="other">other</option>
      </select>
      <input type="text" name="hours" placeholder="enter your operating hours">

      <input type="submit" name="submit" value="register now" onclick="window.location.href='supplier.html';" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

</body>
</html>