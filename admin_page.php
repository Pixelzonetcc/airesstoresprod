<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="images/favicon.png" type="image/png">
   
   <title>Painel Aires Store</title>

   <!-- Link para Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Link para arquivo CSS personalizado -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- Seção do painel de administração começa -->

<section class="dashboard">

   <h1 class="title">Painel</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('Erro na query');
            if(mysqli_num_rows($select_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
         ?>
         <h3>R$<?php echo $total_pendings; ?>/-</h3>
         <p>Pagamentos pendentes</p>
      </div>

      <div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('Erro na query');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
         <h3>R$<?php echo $total_completed; ?>/-</h3>
         <p>Pagamentos concluídos</p>
      </div>

      <div class="box">
         <?php 
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('Erro na query');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>Pedidos realizados</p>
      </div>

      <div class="box">
         <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Erro na query');
            $number_of_products = mysqli_num_rows($select_products);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p>Produtos adicionados</p>
      </div>

      <div class="box">
         <?php 
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('Erro na query');
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>Usuários normais</p>
      </div>

      <div class="box">
         <?php 
            $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('Erro na query');
            $number_of_admins = mysqli_num_rows($select_admins);
         ?>
         <h3><?php echo $number_of_admins; ?></h3>
         <p>Usuários administradores</p>
      </div>

      <div class="box">
         <?php 
            $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('Erro na query');
            $number_of_account = mysqli_num_rows($select_account);
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>Total de contas</p>
      </div>

      <div class="box">
         <?php 
            $select_mensagens = mysqli_query($conn, "SELECT * FROM `message`") or die('Erro na query');
            $number_of_mensagens = mysqli_num_rows($select_mensagens);
         ?>
         <h3><?php echo $number_of_mensagens; ?></h3>
         <p>Novas mensagens</p>
      </div>

   </div>

</section>

<!-- Seção do painel de administração termina -->

<!-- Link para arquivo JS personalizado -->
<script src="js/admin_script.js"></script>

</body>
</html>
