<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   // Verificação se o produto já foi adicionado ao carrinho
   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Consulta falhou');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Este produto já foi adicionado ao carrinho!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('Falha na consulta');
      $message[] = 'Produto adicionado ao carrinho!';
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
   
   <title>Comprar</title>

   <!-- Link CDN Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Link para o arquivo CSS personalizado -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Nossa Loja</h3>
   <p> <a href="index.php">Início</a> / Comprar </p>
</div>

<?php
// Exibindo mensagens de erro ou sucesso
if(isset($message)){
   foreach($message as $msg){
      echo '<div class="message"><span>' . $msg . '</span></div>';
   }
}
?>

<section class="products">

   <h1 class="title">Produtos Recentes</h1>

   <div class="box-container">
      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Falha na consulta');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">R$ <?php echo number_format($fetch_products['price'], 2, ',', '.'); ?> /-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="Adicionar ao Carrinho" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">Nenhum produto adicionado ainda!</p>';
      }
      ?>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- Link para o arquivo JS personalizado -->
<script src="js/script.js"></script>

</body>
</html>
