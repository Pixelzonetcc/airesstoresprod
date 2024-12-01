<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('Erro na query');
   header('location:admin_usuarios.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="images/favicon.png" type="image/png">
   
   <title>Usuários</title>

   <!-- Link para Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Link para o arquivo CSS personalizado -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title"> Contas de Usuários </h1>

   <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('Erro na query');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p> ID do usuário: <span><?php echo $fetch_users['id']; ?></span> </p>
         <p> Nome: <span><?php echo $fetch_users['name']; ?></span> </p>
         <p> E-mail: <span><?php echo $fetch_users['email']; ?></span> </p>
         <p> Tipo de usuário: <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
         <a href="admin_usuarios.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Deseja excluir este usuário?');" class="delete-btn">Excluir Usuário</a>
      </div>
      <?php
         };
      ?>
   </div>

</section>

<!-- Link para o arquivo JS personalizado -->
<script src="js/admin_script.js"></script>

</body>
</html>
