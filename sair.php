<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Erro na query');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(',',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('Erro na query');

   if($cart_total == 0){
      $message[] = 'Seu carrinho está vazio';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'Pedido já realizado!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('Erro na query');
         $message[] = 'Pedido realizado com sucesso!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Erro na query');
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
   
   <title>Finalizar Compra</title>

   <!-- Link para o Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Link para o arquivo CSS personalizado -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Finalizar Compra</h3>
   <p> <a href="index.php">Início</a> / Finalizar Compra </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Erro na query');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo 'R$'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">Seu carrinho está vazio</p>';
   }
   ?>
   <div class="grand-total"> Total: <span>R$<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Realize seu pedido</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Seu nome :</span>
            <input type="text" name="name" required placeholder="Digite seu nome">
         </div>
         <div class="inputBox">
            <span>Seu número :</span>
            <input type="number" name="number" required placeholder="Digite seu número">
         </div>
         <div class="inputBox">
            <span>Seu e-mail :</span>
            <input type="email" name="email" required placeholder="Digite seu e-mail">
         </div>
         <div class="inputBox">
            <span>Forma de pagamento :</span>
            <select name="method">
               <option value="cash on delivery">Dinheiro na entrega</option>
               <option value="credit card">Cartão de Crédito</option>
               <option value="credit card">Cartão de Débito</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Endereço (linha 01) :</span>
            <input type="number" min="0" name="flat" required placeholder="Ex: número do apartamento">
         </div>
         <div class="inputBox">
            <span>Endereço (linha 02) :</span>
            <input type="text" name="street" required placeholder="Ex: nome da rua">
         </div>
         <div class="inputBox">
            <span>Cidade :</span>
            <input type="text" name="city" required placeholder="Ex: São Paulo">
         </div>
         <div class="inputBox">
            <span>Estado :</span>
            <input type="text" name="state" required placeholder="Ex: São Paulo">
         </div>
         <div class="inputBox">
            <span>País :</span>
            <input type="text" name="country" required placeholder="Ex: Brasil">
         </div>
         <div class="inputBox">
            <span>Código Postal :</span>
            <input type="number" min="0" name="pin_code" required placeholder="Ex: 123456">
         </div>
      </div>
      <input type="submit" value="Finalizar Pedido" class="btn" name="order_btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<!-- Link para o arquivo JS personalizado -->
<script src="js/script.js"></script>

</body>
</html>
