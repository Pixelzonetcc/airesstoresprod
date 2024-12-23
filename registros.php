<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('consulta falhou');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'Esse usuário já existe!';
   }else{
      if($pass != $cpass){
         $message[] = 'As senhas não são as mesmas!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('consulta falhou');
         $message[] = 'Registrado com sucesso!';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="images/favicon.png" type="image/png">
   
   <title> Registros </title>

   <!-- link do font awesome cdn -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- link para o arquivo css personalizado -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3> Registre-se agora </h3>
      <input type="text" name="name" placeholder="digite seu nome" required class="box">
      <input type="email" name="email" placeholder="digite seu email" required class="box">
      <input type="password" name="password" placeholder="digite sua senha" required class="box">
      <input type="password" name="cpassword" placeholder="confirme sua senha" required class="box">
      <select name="user_type" class="box">
         <option value="user"> Usuário</option>
         <option value="admin"> Administrador</option>
      </select>
      <input type="submit" name="submit" value="registre-se agora" class="btn">
      <p> Já tem uma conta? <a href="login.php"> Entrar agora </a></p>
   </form>

</div>

</body>
</html>
